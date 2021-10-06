<div class="table-responsive">
    <table class="table table-bordered table-md">
        <thead>
        <tr>
            <th>ID #</th>
            <th>Name</th>
            <th>Quantity Utilized</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) : ?>
            <tr>
                <td><?= $item['item_id'] ?></td>
                <td><?= $item['item_name'] ?></td>
                <td><?= $item['checkout_count'] ?>&nbsp;<?= uom_formatter($item['item_name'], $item['checkout_count'], $item['uom_full']) ?>
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
<div class="text-center">
    <a href="<?= route_to('checkout_report') ?>" class="btn btn-primary mt-2" role="button">Download PDF</a>
</div>
