<div class="page-header">
    <h1>Customers Login Audit</h1>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Login Date / Time</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($audit as $row): ?>
            <tr>
                <td><?=$row->firstname.' '.$row->lastname ?></td>
                <td><?=date('M d, Y g:i A', strtotime($row->created_at))  ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
