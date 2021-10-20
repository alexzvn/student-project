<table class="table w-full table-zebra mt-3">
    <thead>
    <tr>
        <th></th>
        <th>Name</th>
        <th>Price</th>
        <th>Amount</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = 1; $price = 0; foreach ($items as $item): ?>
        <tr>
            <th><?= $i++ ?></th>
            <td><?= e($item->name) ?></td>
            <td>$<?= e(number_format($item->price, 2)) ?></td>
            <td><?= e($item->amount) ?></td>
            <td>$<?= e(number_format($price += $item->amount * $item->price, 2)) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="text-lg font-semibold mt-3">
    Total price: <span class="text-red-500 font-light">$<?= number_format($price, 2) ?></span>
</p>
