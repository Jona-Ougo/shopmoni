<?php pageHeader('Upload Bulk Categories'); ?>


<div class="row">

    <?=form_open_multipart('admin/categories/process_bulk'); ?>

    <div class="col-md-4">
        <h1>Upload .xlsx</h1>
        <div class="table-responsive">
            <table class="table table-hover">
                <caption>.xlsx Format</caption>
                <thead>
                    <tr>
                        <th>parent_id</th>
                        <th>name</th>
                        <th>filter_id</th>
                        <th>description</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="form-group">
            <input type="file" name="file" class="form-control" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>

    </div>


    

    <?=form_close() ?>

    <div class="col-md-4">
       <h1>Categories</h1>
       <div class="table-responsive">
           <table class="table table-hover">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Name</th>
                   </tr>
               </thead>
               <tbody>
                   <?php foreach(\DB\DB::get('categories', [], 'name', 'ASC') as $row): ?>
                       <tr>
                           <td><strong><?=$row->id ?></strong></td>
                           <td><?=$row->name ?></td>
                       </tr>
                   <?php endforeach; ?>
               </tbody>
           </table>
       </div>
   </div>

   <div class="col-md-4">
       <h1>Filters</h1>
       <div class="table-responsive">
           <table class="table table-hover">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>NAME</th>
                   </tr>
               </thead>
               <tbody>
                   <?php foreach(\DB\DB::get('category_filters') as $row): ?>
                    <?php $marketplace = \DB\DB::getRow('categories', ['id'=>$row->category_id]) ?>
                    <tr>
                       <td><strong><?=$row->filter_id ?></strong></td>
                       <td><?=$row->name ?>(<?=$marketplace->name ?>)</td>
                   </tr>
               <?php endforeach; ?>
           </tbody>
       </table>
   </div>
</div>

</div>



<script type="text/javascript">
    $('form').submit(function() {
        $('.btn .btn-primary').attr('disabled', true).addClass('disabled');
    });
</script>