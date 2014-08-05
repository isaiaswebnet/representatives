<div id="wpbody">
  <div id="wpbody-content">
    <div class="wrap">
      <h2>Configurações de Representantes</h2>
      <?php if($_GET['settings-updated']=='true'): ?>
      <?php endif ?>
      <form method="post" action="options.php">
        <input type="hidden" value="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=settings&settings-updated=true">
        <?php 
require_once( 'option.php' );
?>
        <table class="form-table">
          <tbody>
            <tr>
              <th scope="row" colspan="2" style="font-size:16px;font-weight:bold">Estilo Geral</th>
            </tr>
            <tr>
              <th scope="row">Tamanho da fonte</th>
              <td><input type="number" name="r_font_size" value="<?php echo $r_font_size; ?>" step="0" min="11" max="24" /></td>
            </tr>
            <tr>
              <th scope="row">Cor de fundo</th>
              <td><input type="text" name="r_background_color" value="<?php echo $r_background_color;?>" size="10" class="color" /></td>
            </tr>
            <tr>
              <th scope="row">Cor do texto</th>
              <td><input type="text" name="r_text_color" value="<?php echo $r_text_color;?>" size="10" class="color" /></td>
            </tr>
            <tr>
              <th scope="row">Cor da margem</th>
              <td><input type="text" name="r_border_color" value="<?php echo $r_border_color;?>" size="10" class="color" /></td>
            </tr>
            <tr>
              <th scope="row">Espaçamento</th>
              <td><input type="number" name="r_padding" value="<?php echo $r_padding; ?>" step="0" min="10" max="24" /></td>
            </tr>
            <tr>
              <th scope="row" colspan="2" style="font-size:16px;font-weight:bold">Estilo por Mapa</th>
            </tr>
            <tr>
              <th scope="row">Largura</th>
              <td><input type="text" name="r_max_width" value="<?php echo $r_max_width;?>" size="5" placeholder="Max" />
                <input type="text" name="r_min_width" value="<?php echo $r_min_width;?>" size="5" placeholder="Min" /></td>
            </tr>
            <tr>
              <th scope="row">Altura</th>
              <td><input type="text" name="r_height" value="<?php echo $r_height;?>" size="5" /></td>
            </tr>
            <tr>
              <th scope="row">Efeito</th>
              <td><input type="text" name="r_hover" value="<?php echo $r_hover; ?>" size="10" class="color" /></td>
            </tr>
            <tr>
              <th scope="row">Efeito Ativo</th>
              <td><input type="text" name="r_active" value="<?php echo $r_active; ?>" size="10" class="color" /></td>
            </tr>
            <tr>
              <th scope="row" colspan="2" style="font-size:16px;font-weight:bold">Página de cadastro</th>
            </tr>
            <tr>
              <th scope="row">Página</th>
              <td><?php 
$pages = get_pages();
 ?>
                <select name="r_page">
                  <?php 
foreach ($pages as $page_data) {
$page_link = get_page_link($page_data->ID);
?>
                  <option value="<?php echo $page_link;?>" 
<?php echo $r_page == $page_link?"selected":"";?>><?php echo $page_data->post_title;?></option>
                  <?php } ?>
                </select></td>
            </tr>
          </tbody>
        </table>
        <p class="submit">
          <input type="submit" class="button-primary" value="Salvar alterações" />
        </p>
      </form>
    </div>
  </div>
</div>
