<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-list"></i>
                    <?php echo $text_list; ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-4">
                            <form method="post" id="import" action="<?php echo $import_start?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file"
                                           name="import_file"
                                           value=""
                                           placeholder="<?php echo $text_choose_file; ?>"
                                           id="input-file"/>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-8">
                            <button type="submit" form="import" id="button-filter" class="btn btn-primary pull-left">
                                <i class="fa fa-database"></i> <?php echo $text_import_start; ?>
                            </button>
                        </div>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data" id="form-attribute">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <td class="text-center"><?php echo $column_date; ?></td>
                                <td class="text-center"><?php echo $column_products; ?></td>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($queries)) { ?>
                                    <?php foreach ($queries as $query) { ?>
                                        <tr>
                                            <td width="150" class="text-left">
                                                <?php echo $text_import . $query['date']; ?>
                                            </td>
                                            <td class="text-left">
                                                <?php foreach ($query['products'] as $product) { ?>
                                                    <a href="<?php echo $product['href']; ?>" target="_blank">
                                                        <?php echo $product['code']; ?>
                                                    </a>,
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="3"><?php echo $text_no_results; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>