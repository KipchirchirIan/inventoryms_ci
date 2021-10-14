<div class="table-responsive">
    <table class="table table-bordered table-md datatable-lize" id="itemsTable">
        <thead>
        <tr>
            <th>ID #</th>
            <th>Name</th>
            <th>Quantity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td><?= $item['item_id'] ?></td>
                <td><?= $item['item_name'] ?></td>
                <td><?= $item['quantity'] ?>&nbsp;<?= uom_formatter($item['item_name'], $item['quantity'], $item['uom_full']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($items) < 1) : ?>
            <tr>
                <td colspan="8" class="text-center"><strong>0 records found</strong></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>