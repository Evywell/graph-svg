# graph-svg
Draw simple svg graphics

## 1. Simple use

First, you need to import the class : `graph.class.php` using `require` or `include`.

Then, initialize the class like : 
```php 
$graph = new Graphic(width, height, Array options);
```

## 2. Example :
```php
require "class/graph.class.php";
$graph = new Graphic(500, 300, ['minY' => 0, 'maxY' => 60, 'stepY' => 10]);

$data = [
    '2008' => '26',
    '2009' => '54',
    '2010' => '10',
    '2011' => '17.6',
    '2012' => '15',
    '2013' => '5'
  ];

echo $graph->draw($data);
```

It will generate the following result.
```html
 <svg width="850" height="420">
   <g class="graph-x">
     <text x="50" y="370" style="text-anchor:middle; baseline-shift:-0.5ex;">2008</text>
     <text x="183" y="370" style="text-anchor:middle; baseline-shift:-0.5ex;">2009</text>
     <text x="316" y="370" style="text-anchor:middle; baseline-shift:-0.5ex;">2010</text>
     <text x="449" y="370" style="text-anchor:middle; baseline-shift:-0.5ex;">2011</text>
     <text x="582" y="370" style="text-anchor:middle; baseline-shift:-0.5ex;">2012</text>
     <text x="715" y="370" style="text-anchor:middle; baseline-shift:-0.5ex;">2013</text>
   </g>
   <g class="graph-y">
     <text x='40' y='350' style="text-anchor:end; baseline-shift:-0.5ex;">0</text>
     <text x='40' y='300' style="text-anchor:end; baseline-shift:-0.5ex;">10</text>
     <text x='40' y='250' style="text-anchor:end; baseline-shift:-0.5ex;">20</text>
     <text x='40' y='200' style="text-anchor:end; baseline-shift:-0.5ex;">30</text>
     <text x='40' y='150' style="text-anchor:end; baseline-shift:-0.5ex;">40</text>
     <text x='40' y='100' style="text-anchor:end; baseline-shift:-0.5ex;">50</text>
     <text x='40' y='50' style="text-anchor:end; baseline-shift:-0.5ex;">60</text>
   </g>
   <path d="M 50 350 L 50 220 L 183 80 L 316 300 L 449 262 L 582 275 L 715 325 L 715 350 " class="graph-fill"/>
   <path d="M 50 350 L 50 220 L 183 80 L 316 300 L 449 262 L 582 275 L 715 325 " class="graph-path"/>
   <path d="M 50 50 L 50 350 L 717 350" class="graph-line"/>
   <a xlink:href="#" class="link-circle">
    <circle cx="50" cy="220" r="5" data-value="26" class="graph-circle"/>
   </a>
   <a xlink:href="#" class="link-circle">
    <circle cx="183" cy="80" r="5" data-value="54" class="graph-circle"/>
   </a>
   <a xlink:href="#" class="link-circle">
    <circle cx="316" cy="300" r="5" data-value="10" class="graph-circle"/>
   </a>
   <a xlink:href="#" class="link-circle">
    <circle cx="449" cy="262" r="5" data-value="17.6" class="graph-circle"/>
   </a>
   <a xlink:href="#" class="link-circle">
    <circle cx="582" cy="275" r="5" data-value="15" class="graph-circle"/>
   </a>
   <a xlink:href="#" class="link-circle">
    <circle cx="715" cy="325" r="5" data-value="5" class="graph-circle"/>
   </a>
 </svg>
```

## 3. Options
You can personalize the Y axis with the following options:
 - `minY` -> The first point of the Y axis (generally 0, origin)
 - `maxY` -> The maximum value of the Y axis 
 - `stepY`-> The step between two graduations
