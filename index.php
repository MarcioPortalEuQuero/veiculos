<?php
/**
* @package Veiculos
* @version 0.1
*/
/*
Plugin Name: Veículos
Plugin URI: https://maickon.github.io/projetos/veiculos
Description: O Veículos é um projeto que lista via interface amigável diversos veículos para anuncios de venda. 
Author: Maickon Rangel
Version: 0.1
Author URI: https://maickon.cf/
*/
function get_json_veiculos() {
$veiculos = file_get_contents('https://portaleuquero.com.br/json.php');
return json_decode($veiculos);
}
function if_has($value, $formated){
if (isset($value))
return $formated;
}
function show_veiculos() {
$veiculos = get_json_veiculos();
echo '<!--<input type="text" class="search_widget_input" name="search-car" id="search-car" placeholder="Pesquisar por um veículo digitanto modelo, marca ou valor."> -->
<div class="car-datails">
<div id="car-active" data-id=""></div>
';
foreach ($veiculos as $key => $value) {
echo '
<div class="car-descript" id="car-desc-'.$value->Id.'">
<img src="'.$value->Fotos[0].'">
<div class="car-text" data-id="'.$value->Id.'">
<p>'.$value->Marca.'</p>
<p>'.$value->Modelo.'</p>
<p style="display:none;">'.number_format($value->Preco, 2, ',', '.').'</p>
</div>
</div>';
echo '<div class="view-car" style="display:none;" id="car-full-desc-'.$value->Id.'">
<div class="close-bt" data-id="'.$value->Id.'">X</div>
<div class="full-pic" data-id="'.$value->Id.'" data-current="0" id="'.$value->Id.'">
<div class="prev-next">
<div class="prev" data-id="'.$value->Id.'"><</div>
<div class="next" data-id="'.$value->Id.'">></div>
</div>';
foreach ($value->Fotos as $imgKey => $img) {
if ($imgKey == 0) {
echo '<img class="car-pics car-pics-'.$value->Id.'" src="'.$img.'" style="display:block;">';
} else {
echo '<img class="car-pics car-pics-'.$value->Id.'" src="'.$img.'">';
}
}
echo '
</div>
<div class="full-desc">
<div class="title">'.$value->Loja.'</div>
<div class="title"><a href="http://www.marioveiculos.com.br" target="_blank">Visitar o Site</a></div>
<div>'.if_has($value->Marca, '<b>Marca:</b> ' . $value->Marca).'</div>
<div>'.if_has($value->Modelo, '<b>Modelo:</b> ' . $value->Modelo).'</div>
<div>'.if_has($value->Versao, '<b>Versao:</b> ' . $value->Versao).'</div>
<div>'.if_has($value->Opcionais, '<b>Opcionais:</b> ' . $value->Opcionais).'</div>
<div><b>Preço:</b> R$ '.number_format($value->Preco, 2, ',', '.').'</div>
</div>
</div>
';
}
echo '</div>';
}
add_shortcode('veiculos', 'show_veiculos');
function car_datails_css() {
wp_enqueue_style( 'index-css', plugins_url( '/css/index.css', __FILE__ ));
wp_enqueue_script( 'index-js', plugins_url( '/js/index.js', __FILE__ ));
}
add_action( 'wp_head', 'car_datails_css' ); ?>