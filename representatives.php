<?php
/*
Plugin Name: Representatives
Plugin URI:  https://github.com/isaiaswebnet/representative
Description: Mapa de Representante Comercial, apenas insira esse shortcode [representative] na página de representantes do seu site. É importe o XML com os estados que se encontar na raiz do plugin Representatives.
Author: Isaías Oliveira
Version: 1.0
Author URI: https://www.facebook.com/isaiaswebnet
License: GPLv2
*/

define('R_PLUGIN_URL', WP_PLUGIN_URL.'/representatives');

function r_menu() {
	add_options_page('Options Representatives','Configurações de Representantes','manage_options','r_options','r_options');
}

function r_register_settings() {
	
	// Style Geral
	register_setting( 'r-options-group', 'r_font_size' );
	register_setting( 'r-options-group', 'r_background_color' );
	register_setting( 'r-options-group', 'r_border_color' );
	register_setting( 'r-options-group', 'r_text_color' );
	register_setting( 'r-options-group', 'r_padding' );
	
	// Style Map
	register_setting( 'r-options-group', 'r_max_width' );
	register_setting( 'r-options-group', 'r_min_width' );
	register_setting( 'r-options-group', 'r_height' );
	register_setting( 'r-options-group', 'r_hover' );
	register_setting( 'r-options-group', 'r_active' );
	
	// Page Form
	register_setting( 'r-options-group', 'r_page' );
}

function r_options(){
	require_once( 'inc/settings.php' );
}

function r_admin_scripts() {
	wp_enqueue_script( 'jscolor', R_PLUGIN_URL.'/js/rcolor.js');
}


$labels = array(
				'name' => 'Representantes',
				'singular_name' => 'Representantes',
				'add_new' => 'Adicionar',
				'add_new_item' => 'Adicionar Novo',
				'edit_item' => 'Editar',
				'new_item' => 'Novo',
				'view_item' => 'Ver detalhes',
				'search_items' => 'Pesquisar por Representante',
				'not_found' =>  'Não foram encontrados Representante com este critério',
				'not_found_in_trash' => 'Não foram encontrado no lixo Representante com os critérios',
				'view' =>  'Ver Representante'
			);
$args = array(
			'labels' => $labels,
			'singular_label' => 'Item Representante',
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'has_archive' => false,
			'rewrite' => false,
			'menu_position' => 5,
			'supports' => array('title'/*, 'editor', 'excerpt', 'thumbnail'*/)
			); 
			
register_post_type( 'representative', $args); 	
	
$labels = array(
	'name' => 'Estados',
	'singular_name' => 'Estados',
	'search_items' => 'Buscar Estado',
	'all_items' => 'Todos os Estado',
	'parent_item' => 'Estado Pai',
	'parent_item_colon' => 'Estado Pai:',
	'edit_item' => 'Editar Estado', 
	'update_item' => 'Atualizar Estado',
	'add_new_item' => 'Adicionar novo Estado',
	'new_item_name' => 'Novo Estado',
	); 	

register_taxonomy(
	"state", 
	"representative", 
	
	array(
		"hierarchical" => true, 
		"labels" => $labels,
		"rewrite" => false
		)
	);
	
	function r_meta_box_admin(){
		add_meta_box("r_meta", "Dados do Representante", "r_meta", "representative", "normal", "low");
	}
	
	function r_meta (){
		global $post;
		$custom = get_post_custom($post->ID);
		$tipovenda = $custom["tipo_venda"][0];
		$rua = $custom["rua"][0];
		$numero = $custom["numero"][0];
		$bairro = $custom["bairro"][0];
		$cep = $custom["cep"][0];
		$cidade = $custom["cidade"][0];
		$telefone = $custom["telefone"][0];
		$celular = $custom["celular"][0];
		$fax = $custom["fax"][0];
		$email = $custom["email"][0];
		$site = $custom["site"][0];
	?>
    
    <table class="form-table">
	<tbody>
		<tr>
			<th><label>Tipo de Venda</label></th>
			<td><input type="text" name="tipo_venda" value="<?php echo $tipovenda; ?>" size="40" /></td>
		</tr>
		<tr>
			<th><label>Av/Rua/Tv</label></th>
			<td><input type="text" name="rua" value="<?php echo $rua; ?>" size="40" /></td>
		</tr>
		<tr>
			<th><label>Número</label></th>
			<td><input type="text" name="numero" value="<?php echo $numero; ?>" size="7" /></td>
		</tr>
        <tr>
			<th><label>Bairro</label></th>
			<td><input type="text" name="bairro" value="<?php echo $bairro; ?>" size="40" /></td>
		</tr>
        <tr>
			<th><label>CEP</label></th>
			<td><input type="text" name="cep" value="<?php echo $cep; ?>" size="7" /></td>
		</tr>
        <tr>
			<th><label>Cidade</label></th>
			<td><input type="text" name="cidade" value="<?php echo $cidade; ?>" size="40" /></td>
		</tr>
		<tr>
			<th><label>Fone Fixo</label></th>
			<td><input type="tel" name="telefone" value="<?php echo $telefone; ?>" size="11" /></td>
		</tr>
		<tr>
			<th><label>Celular</label></th>
			<td><input type="tel" name="celular" value="<?php echo $celular; ?>" size="11" /></td>
		</tr>
		<tr>
			<th><label>FAX</label></th>
			<td><input type="tel" name="fax" value="<?php echo $fax; ?>" size="11" /></td>
		</tr>
		<tr>
			<th><label>E-mail</label></th>
			<td><input type="email" name="email" value="<?php echo $email; ?>" size="40" /></td>
		</tr>
		<tr>
			<th><label>Site</label></th>
			<td><input type="text" name="site" value="<?php echo $site; ?>" size="40" /></td>
		</tr>
	</tbody>
</table>
	<?php
	}
	
	function r_save(){
		global $post;
		update_post_meta($post->ID, "tipo_venda", $_POST["tipo_venda"]);
		update_post_meta($post->ID, "rua", $_POST["rua"]);
		update_post_meta($post->ID, "numero", $_POST["numero"]);
		update_post_meta($post->ID, "bairro", $_POST["bairro"]);
		update_post_meta($post->ID, "cep", $_POST["cep"]);
		update_post_meta($post->ID, "cidade", $_POST["cidade"]);
		update_post_meta($post->ID, "telefone", $_POST["telefone"]);
		update_post_meta($post->ID, "celular", $_POST["celular"]);
		update_post_meta($post->ID, "fax", $_POST["fax"]);
		update_post_meta($post->ID, "email", $_POST["email"]);
		update_post_meta($post->ID, "site", $_POST["site"]);
	}
	

function r_shortcode() {
	require_once( 'inc/option.php' ); 
?>
         
<script>

$ = jQuery.noConflict();
$(function(){

$(".fil1").click(function(){

var state = $(this).attr('id');
var name = $(this).attr('title');
//window.location.href = '#'+state;

$('html, body').delay(1000).animate({scrollTop:$('#r_state').offset().top}, 1000);

$('#r_loading').hide().ajaxStart( function() {
$(this).show();
} ).ajaxStop ( function(){
$(this).hide();
});

$('#r_list').css('display', 'inline-block').hide().fadeIn();

$('#r_state').html('<img src="<?php echo R_PLUGIN_URL.'/images/flag/';?>'+state+'.png" width: 25px; /> '+name);

$(this).css("fill","<?php echo '#'.$r_active;?>");

if(state){
$.ajax({url: '<?php echo R_PLUGIN_URL.'/data.php';?>', data: {'STATE' : state}, type: 'POST', cache: false, success: function(d){
$('#r_result').html(d);
}
});
}
})
.hover(function(){
	$(document).bind('mousemove', function(e){
    	$('#r_tooltip').css({
    	   left:  e.pageX + 10,
    	   top:   e.pageY - 40
    	});
	});
	var name = $(this).attr('title');
		$('#r_tooltip').css('display', 'block').html(name).offset({
			left: e.page, 
			top: e.pageY
		});
},
function(){
	$('#r_tooltip').css('display', 'none');
});
});
</script>
<article>
<p>Veja a lista de representantes mais próxima de você</p>
<div id="r_tooltip"></div>
<div id="r_mapa">
<?php include('inc/svg.php');?>
</div>
<div id="r_list">
<div id="r_state"></div>
<div id="r_loading"></div>
<div id="r_result"></div>
<div style="padding:10px">Junte-se ao nosso time! Seja um Representante Comercial. <a href="<?php echo $r_page?>" class="r_page"><strong>Cadastre-se agora!</strong></a>
</div>

</div>
</article>
<?php
}

add_action('admin_menu', 'r_menu');
add_action( 'admin_init', 'r_register_settings' );
add_action( 'admin_init', 'r_meta_box_admin' );
add_action ('save_post', 'r_save');
add_action('admin_enqueue_scripts',	'r_admin_scripts' );
add_shortcode( 'representatives', 'r_shortcode' );

?>