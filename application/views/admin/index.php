<form id="regForm">
    <div class="tab">
        <table>
            <tr>
                <th>Transaction</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
                <th>Item</th>
            </tr>

            <?php foreach ($transaction_detail as $p) : ?>
                <tr>
                    <td><?= $p['document_code'] . ' ' . $p['document_number'] ?></td>
                </tr>
            <?php endforeach ?>

        </table>
    </div>
</form>