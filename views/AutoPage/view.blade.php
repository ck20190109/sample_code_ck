@include('view_header')
<?php if (config('app.layout.left')==true) { ?>
@include('view_left')
<?php } ?>

<?php echo html_entity_decode($data_list[0]->post_content); ?>

<?php if (config('app.layout.right')==true) { ?>
@include('view_right')
<?php } ?>
@include('view_footer')
