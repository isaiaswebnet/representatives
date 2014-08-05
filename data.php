<?php

extract($_POST);

require_once( dirname( dirname( dirname( dirname( __FILE__ )))) . '/wp-load.php' );

$args = array(
	'tax_query' => array(
		array(
            'taxonomy' => 'state',
            'field' => 'slug',
            'terms' => array( $STATE )
        ),
    ),
    'post_type' => 'representative'
);

$loop = new WP_Query($args);
	if($loop->have_posts()) : 
	while($loop->have_posts()) : 
	$loop->the_post();
	
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
	$url_email = preg_replace('#^https?://#', '', $email);
	$url_site = preg_replace('#^https?://#', '', $site);
	?>
<table id="r_table" class="default">
	<tbody>
		<tr>
			<th>Empresa:</th>
			<td><?php the_title();?></td>
		</tr>
        <?php if($tipovenda) : ?>
		<tr>
			<th>Tipo de Venda:</th>
			<td><?php echo $tipovenda;?></td>
		</tr>
        <?php endif; if( !empty($rua) and !empty($numero) and !empty($bairro) and !empty($cep) ) : ?>
		<tr>
			<th>Endereço:</th>
			<td><?php echo $rua.', '.$numero.' - '.$bairro.' - '.$cep;?></td>
		</tr>
        <?php endif; if($cidade) : ?>
		<tr>
			<th>Cidade:</th>
			<td><?php echo $cidade;?></td>
		</tr>
        <?php endif; if($telefone) : ?>
		<tr>
			<th>Fone Fixo:</th>
			<td><?php echo $telefone;?></td>
		</tr>
        <?php endif; if($celular) : ?>
		<tr>
			<th>Celular:</th>
			<td><?php echo $celular;?></td>
		</tr>
        <?php endif; if($fax) : ?>
		<tr>
			<th>FAX:</th>
			<td><?php echo $fax;?></td>
		</tr>
        <?php endif; if($email) : ?>
		<tr>
			<th>E-mail:</th>
			<td><?php echo '<a href="mailto:'.$email.'" class="link_site">'.$url_email.'</a>';?></td>
		</tr>
        <?php endif; if($site) : ?>
		<tr>
			<th>Site:</th>
			<td><?php echo '<a href="'.$site.'" class="link_site" target="_blank">'.$url_site.'</a>';?></td>
		</tr>
        <?php endif; ?>
		<tr>
			<th colspan="2" style="padding:6px"></th>
		</tr>
	</tbody>
</table>
<?php
	endwhile;
	endif;