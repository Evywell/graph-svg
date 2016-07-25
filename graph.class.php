<?php

class Graphic{

    private $width;
    private $height;
    private $options;
    private $gutters;
    private $data = [];

    public function __construct($width, $height, $options = []){
        $default_options = ['minY' => 0, 'maxY' => 30, 'stepY' => 5];
        $this->width = $width;
        $this->height = $height;
        $this->options = array_merge($default_options, $options);
        $this->gutters = 50;
    }

    public function draw($data){
        $this->data = $data;
        $html = '<svg width="' . $this->width . '" height="' . $this->height . '">';
        $html .= $this->axeX();
        $html .= $this->axeY();
        $html .= $this->drawFill();
        $html .= $this->drawPath();
        $html .= $this->drawAxes();
        $html .= $this->drawCircle();
        $html .= '</svg>';
        return $html;
    }

    private function axeX(){
        $data = $this->data;
        $count = count($data);
        $step = floor(($this->width - $this->gutters) / $count);
        $height = $this->height - $this->gutters;
        $html = '<g class="graph-x">';

        foreach (array_keys($data) as $k => $v) {
            $html .= '<text x="' . (($this->gutters) + ($k * $step)) . '" y="' . $height . '" style="text-anchor:middle; baseline-shift:-0.5ex;">' . $v . '</text>';
        }

        $html .= '</g>';
        return $html;
    }

    private function axeY(){
        $data = $this->data;
        $nbelements = ($this->options['maxY'] - $this->options['minY']) / $this->options['stepY'] + 1;
        $step = floor(($this->height - $this->gutters - 20) / $nbelements);
        $html = '<g class="graph-y">';

        for($i = 0; $i < $nbelements; $i++){
            $y = ($this->height - $this->gutters - 20) - ($step * $i);
            $html .= "<text x='40' y='" . $y . "' style=\"text-anchor:end; baseline-shift:-0.5ex;\">" . $i * $this->options['stepY'] . "</text>";
        }
        $html .= '</g>';
        return $html;
    }

    private function drawAxes(){
        $data = $this->data;
        $height = $this->height - $this->gutters - 20;
        $count = count($data);
        $stepX = floor(($this->width - $this->gutters) / $count);
        $html = '<path d="M ' . $this->gutters . ' ' . $this->gutters . ' L ' . $this->gutters . ' ' . $height . ' L ' . ($this->width - $stepX) . ' ' . $height .'" class="graph-line"/>';
        return $html;
    }

    private function drawGraph($data, $type, $close = false){
        $values = array_values($data);
        $height = $this->height - $this->gutters - 20;

        $count = count($data);
        $stepX = floor(($this->width - $this->gutters) / $count);
        $nbelements = ($this->options['maxY'] - $this->options['minY']) / $this->options['stepY'] + 1;
        $stepY = floor($height / $nbelements);

        $aze = $stepY / $this->options['stepY'];
        $html = '<path d="M ' . $this->gutters . ' ' . $height . ' ';
        foreach($values as $k => $value){
            $html .= 'L ' . ($this->gutters + ($stepX * $k)) . ' ' . ($height - ($aze * $value)) . ' ';
        }
        if($close){
            $html .= 'L ' . ($this->gutters + ($stepX * $k)) . ' ' . $height . ' ';
        }
        $html .= '" class="' . $type . '"/>';
        return $html;
    }

    private function drawPath(){
        return $this->drawGraph($this->data, 'graph-path');
    }

    private function drawFill(){
        return $this->drawGraph($this->data, 'graph-fill', true);
    }

    private function drawCircle(){
        $data = $this->data;
        $values = array_values($data);
        $height = $this->height - $this->gutters - 20;

        $count = count($data);
        $stepX = floor(($this->width - $this->gutters) / $count);
        $nbelements = ($this->options['maxY'] - $this->options['minY']) / $this->options['stepY'] + 1;
        $stepY = floor($height / $nbelements);

        $aze = $stepY / $this->options['stepY'];
        $html = '';
        foreach($values as $k => $value){
            $html .= '<a xlink:href="#" class="link-circle"><circle cx="' . ($this->gutters + ($stepX * $k)) . '" cy="' . ($height - ($aze * $value)) . '" r="5" data-value="' . $value . '" class="graph-circle"/></a>';
        }
        return $html;
    }


}
