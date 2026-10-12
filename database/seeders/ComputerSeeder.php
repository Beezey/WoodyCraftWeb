<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Computer;
use Illuminate\Database\Seeder;

class ComputerSeeder extends Seeder
{
    /**
     * Ordinateurs de démonstration, par catégorie : [nom, prix, description].
     */
    private const COMPUTERS = [
        'Portables' => [
            ['Portable Érable 14', 749.00, "Écran 14\" Full HD IPS, Intel Core i5-1335U, 16 Go de RAM, SSD NVMe 512 Go, 1,4 kg, autonomie 10 h."],
            ['Portable Érable 16', 849.00, "Écran 16\" Full HD+ IPS, Intel Core i5-1340P, 16 Go de RAM, SSD NVMe 512 Go, 1,8 kg, autonomie 9 h."],
            ['Portable Noyer 15', 1099.00, "Écran 15,6\" QHD 120 Hz, AMD Ryzen 7 7735HS, 16 Go de RAM, SSD NVMe 1 To, châssis aluminium."],
            ['Portable Noyer 17', 1299.00, "Écran 17,3\" QHD 144 Hz, AMD Ryzen 7 7840HS, 32 Go de RAM, SSD NVMe 1 To, clavier rétroéclairé."],
            ['Portable Cèdre 13', 599.00, "Écran 13,3\" Full HD, Intel Core i3-1315U, 8 Go de RAM, SSD 256 Go, 1,1 kg, idéal pour les études."],
            ['Portable Hêtre 14', 679.00, "Écran 14\" Full HD, AMD Ryzen 5 7530U, 8 Go de RAM, SSD NVMe 512 Go, 1,5 kg, autonomie 11 h."],
            ['Portable Frêne 15', 929.00, "Écran 15,6\" Full HD tactile, Intel Core i7-1355U, 16 Go de RAM, SSD NVMe 512 Go, lecteur d'empreintes."],
            ['Portable Olivier 16', 1149.00, "Écran 16\" OLED 2,8K, Intel Core i7-13700H, 16 Go de RAM, SSD NVMe 1 To, 1,7 kg."],
        ],
        'PC de bureau' => [
            ['Tour Chêne', 899.00, "Intel Core i5-13400, 16 Go de RAM DDR4, SSD NVMe 1 To, Wi-Fi 6, boîtier moyen tour silencieux."],
            ['Tour Châtaignier', 649.00, "AMD Ryzen 5 5600G, 16 Go de RAM DDR4, SSD NVMe 512 Go, graphiques intégrés, bureautique et multimédia."],
            ['Tour Merisier', 1199.00, "Intel Core i7-13700, 32 Go de RAM DDR5, SSD NVMe 1 To et disque dur 2 To, station de travail polyvalente."],
            ['Tout-en-un Tilleul 24', 799.00, "Écran 23,8\" Full HD intégré, Intel Core i5-1335U, 16 Go de RAM, SSD 512 Go, webcam et haut-parleurs."],
        ],
        'Gaming' => [
            ['Tour Séquoia', 1499.00, "AMD Ryzen 7 7700, GeForce RTX 4070 12 Go, 32 Go de RAM DDR5, SSD NVMe 1 To, refroidissement liquide."],
            ['Tour Ébène', 1999.00, "Intel Core i7-14700KF, GeForce RTX 4080 Super 16 Go, 32 Go de RAM DDR5, SSD NVMe 2 To, alimentation 850 W Gold."],
            ['Tour Acajou', 1099.00, "AMD Ryzen 5 7600, Radeon RX 7600 XT 16 Go, 16 Go de RAM DDR5, SSD NVMe 1 To, boîtier vitré RGB."],
            ['Portable Baobab 17', 1699.00, "Écran 17,3\" QHD 165 Hz, Intel Core i7-13700HX, GeForce RTX 4070 8 Go, 32 Go de RAM, SSD NVMe 1 To."],
        ],
        'Mini PC' => [
            ['Mini PC Bouleau', 429.00, "Intel N100, 16 Go de RAM, SSD 512 Go, double sortie HDMI 4K, format 12 x 12 cm, silencieux."],
            ['Mini PC Saule', 329.00, "Intel N95, 8 Go de RAM, SSD 256 Go, Wi-Fi 5, fixation VESA fournie, idéal pour la bureautique."],
            ['Mini PC Bambou', 599.00, "AMD Ryzen 7 5825U, 16 Go de RAM, SSD NVMe 512 Go, triple affichage, Wi-Fi 6."],
            ['Mini PC Aulne', 749.00, "Intel Core i7-1360P, 32 Go de RAM DDR5, SSD NVMe 1 To, Thunderbolt 4, double port Ethernet 2,5 Gb."],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::COMPUTERS as $categoryName => $computers) {
            $category = Category::firstOrCreate(['name' => $categoryName]);

            foreach ($computers as [$name, $price, $description]) {
                Computer::updateOrCreate(
                    ['name' => $name],
                    [
                        'category_id' => $category->id,
                        'description' => $description,
                        'image'       => $this->placeholder($name, $categoryName),
                        'price'       => $price,
                    ]
                );
            }
        }
    }

    /**
     * Image d'attente aux couleurs de la maquette, au même format que les images envoyées (data URI).
     */
    private function placeholder(string $name, string $categoryName): string
    {
        $name = htmlspecialchars($name, ENT_XML1);
        $categoryName = htmlspecialchars(mb_strtoupper($categoryName), ENT_XML1);

        $svg = <<<SVG
<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" width="640" height="480" viewBox="0 0 640 480">
    <rect width="640" height="480" fill="#F4ECDD"/>
    <rect x="200" y="110" width="240" height="150" rx="10" fill="#1F4A3A"/>
    <rect x="214" y="124" width="212" height="122" rx="4" fill="#F4ECDD"/>
    <rect x="170" y="268" width="300" height="16" rx="8" fill="#2E2118"/>
    <text x="320" y="345" text-anchor="middle" font-family="Georgia, serif" font-size="34" fill="#2E2118">{$name}</text>
    <text x="320" y="385" text-anchor="middle" font-family="Arial, sans-serif" font-size="16" letter-spacing="3" fill="#1F4A3A">{$categoryName}</text>
</svg>
SVG;

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
