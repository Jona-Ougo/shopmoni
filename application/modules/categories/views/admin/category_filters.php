<?php pageHeader('Categories Filter'); ?>

<div class="pull-right">
    <a class="btn btn-primary" href="<?=site_url('admin/category_filter_form'); ?>">
        <i class="icon-plus"></i> Add New Category Filter
    </a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th><i class="fa fa-ellipsis-v"></i></th>
            <th>Category</th>
            <th>Filter Name</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php if(count($filters) < 1): ?>
            <tr>
                <td class="text-center" colspan="5">
                    No Category Filters saved yet.
                </td>
            </tr>
        <?php endif; ?>
        
        <?php $count = 1; ?>
        <?php foreach($filters as $row): ?>
            <tr>
                <td><?=$count++ ?></td>
                <td><?=\DB\DB::getRow('categories', ['id'=>$row->category_id])->name ?></td>
                <td><?=$row->name ?></td>
                <td><?=$row->description ?></td>
                <td>
                    <a href="<?=site_url('admin/category/category_filter/'.$row->filter_id) ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>