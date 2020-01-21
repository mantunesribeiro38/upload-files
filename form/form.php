<div class="content">
    <div class="box">
        <input  id="file" class="inputfile" type="file"  name="wp_custom_attachment[]" data-multiple-caption="{count} arquivos selecionados" multiple="multiple" accept="application/pdf" >
        <label class="file" for="file">
          <figure>
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>
        </figure> <span>Escolha um arquivo&hellip;</span></label>
    </div>
</div>
<br>
<br>
<div class="title-attachment">

    <?php if ($attachmentsList) { ?>
        <h3 class="list-attachment">Lista de Anexos</h3>
    <?php } else { ?>
        <h3 class="list-no-attachment">Nenhum anexo submetido</h3>
    <?php } ?>

<div class="container_attachment">
  <?php

  if ($attachmentsList) {
      foreach ( $attachmentsList as $attachment ) {
  ?>
  <div class="attachment-info " id="attachment_item_<?php echo $attachment->idAttachment?>">
      <div class="thumbnail thumbnail-application">
          <img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/icons/pdf-icon.svg';?>" class="icon" draggable="false" alt="">
      </div>
      <div class="details">
          <div class="filename"><a  target="_blank" href="<?php echo esc_url($attachment->url); ?>">Visualizar arquivo</a></div>
          <br>
          <div class="action">
              <div class="file-size"><?php echo $attachment->filename?></div>
              <div class="uploaded"><?php echo $attachment->filesize?></div>
              <button type="button" class=" button-link delete-attachment">Excluir permanentemente</button>
              <input type="hidden" name="id_attachment" value="<?php echo $attachment->idAttachment?>" id="id_attachment" />
          </div>
      </div>
  </div>

  <?php }?>
  <?php }?>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url( __FILE__ ) . '../assets/css/style.css';?>" />  