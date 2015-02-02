<?php

class MeasuresTableSeeder extends Seeder
{

    public function run()
    {
        $measures = array(
            'KILO' => "kg",
            'GRAMO' => "g",
            'METRO LINEAL' => "m",
            'METRO CUADRADO' => "m^2",
            'METRO CUBICO' => "m^3",
            'PIEZA' => "pz",
            'CABEZA' => "cbz",
            'LITRO' => "lt",
            'PAR' => "par",
            'KILOWATT' => "kw",
            'MILLAR' => "Mil",
            'JUEGO' => "jg",
            'KILOWATT/HORA' => "kw/h",
            'TONELADA' => "tn",
            'BARRIL' => "Bls",
            'GRAMO NETO' => "gn",
            'DECENAS' => "dec",
            'CIENTOS' => "cen",
            'DOCENAS' => "doc",
            'CAJA' => "ca",
            'BOTELLA' => "btl"
        );

        foreach ($measures as $measure => $value) {
            Measure::create(array("description" => $measure, "abbreviation" => $value));
        }
    }

}