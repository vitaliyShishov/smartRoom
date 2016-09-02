<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="submit" 
                    form="form-gallery"
                    data-toggle="tooltip"
                    title="<?php echo $text_save; ?>"
                    class="btn btn-primary">
                <i class="fa fa-save"></i>
            </button>
        </div>
        <h1><?php echo $heading_title; ?></h1>
        <ul class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li>
                <a href="<?php echo $breadcrumb['href']; ?>">
                    <?php echo $breadcrumb['text']; ?>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="container-fluid">
<?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php } ?>
<?php if ($error_saving) { ?>
<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_saving; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php } ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $heading_title ?></h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo $action; ?>"
              method="post"
              enctype="multipart/form-data"
              id="form-gallery"
              class="form-horizontal">
            <div class="tab-content">
                <div class="table-responsive">
                    <table id="images" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-left"><?php echo $text_image; ?></td>
                                <td class="text-right"><?php echo $text_image_type; ?></td>
                                <td class="text-right"><?php echo $text_sort_order; ?></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $image_row = 0; ?>
                        <?php foreach ($gallery_images as $key => $image) { ?>
                            <tr id="image_row_<?php echo $image_row; ?>">
                                <td class="text-left">
                                    <a href=""
                                       id="thumb-image<?php echo $image_row; ?>"
                                       data-toggle="image"
                                       class="img-thumbnail">
                                        <img src="<?php echo $image['image_resize']; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
                                    <input type="hidden"
                                           name="gallery_images[<?php echo $image_row; ?>][image]"
                                           value="<?php echo $image['image']; ?>"
                                           id="input-image<?php echo $image_row; ?>" />
                                </td>
                                <td class="text-center">
                                    <div class="col-sm-12">
                                        <select name="gallery_images[<?php echo $image_row; ?>][is_full]"
                                                   class="form-control">
                                            <?php foreach ($image_types as $type) { ?>
                                                <?php if ($type['value'] == $image['is_full']) { ?>
                                                    <option value="<?php echo $type['value']; ?>"selected="selected">
                                                        <?php echo $type['name']; ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $type['value']; ?>">
                                                        <?php echo $type['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <input type="text"
                                           name="gallery_images[<?php echo $image_row; ?>][sort_order]"
                                           value="<?php echo $image['sort_order']; ?>"
                                           placeholder="<?php echo $text_sort_order; ?>"
                                           class="form-control" />
                                </td>
                                <td class="text-center">
                                    <button type="button"
                                            onclick="removeImage('<?php echo $image_row; ?>');"
                                            data-toggle="tooltip"
                                            title="<?php echo $button_delete; ?>"
                                            class="btn btn-danger">
                                        <i class="fa fa-minus-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php $image_row++; ?>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-center">
                                    <button type="button"
                                            onclick="addImage();"
                                            data-toggle="tooltip"
                                            title="<?php echo $button_add; ?>"
                                            class="btn btn-primary">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript"><!--
        var image_row = <?php echo $image_row; ?>;

        function addImage() {

            html = '<tr id="image_row_'+ image_row + '">';
            html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /><input type="hidden" name="gallery_images[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
            html += '<td class="text-center"> ';
            html += '<div class="col-sm-12">';
            html += '<select name="gallery_images[' + image_row + '][is_full]" class="form-control"> ';
            html += '<option value="1"><?php echo $text_image_type_full; ?></option>';
            html += '<option value="0"><?php echo $text_image_type_half; ?></option>';
            html += '</select>';
            html += '</div>';
            html += '  <td class="text-right"><input type="text" name="gallery_images[' + image_row + '][sort_order]" value="" placeholder="<?php echo $text_sort_order; ?>" class="form-control" /></td>';
            html += '</td>';
            html += '  <td class="text-center"><button type="button" onclick="removeImage(' + image_row + ');" data-toggle="tooltip" title="<?php echo $button_delete_image; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#images tbody').append(html);

            image_row++;
        }
//--></script>
<script type="text/javascript">
    function removeImage(imageRow) {
        $('#image_row_' + imageRow + '').remove();
    }
</script>
</div>
<?php echo $footer; ?>