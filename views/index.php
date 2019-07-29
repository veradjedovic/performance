<br />
<h1>All Clients</h1>
<br />
              
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Street</th>
        <th scope="col">Postal Code</th>
        <th scope="col">City</th>
        <th scope="col">Country</th>
    </tr>
    </thead>
    <tbody>

    <?php
        if ($data['data'] && $data['data'] != []) {
            $i = 1;
            foreach ($data['data'] as $k=>$v) {
                ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $v->first_name ? replace($v->first_name) : '' ?></td>
                    <td><?= $v->last_name ? replace($v->last_name) : '' ?></td>
                    <td><?= $v->street ? replace($v->street) : '' ?></td>
                    <td><?= $v->postal ? replace($v->postal) : '' ?></td>
                    <td><?= $v->city ? replace($v->city) : '' ?></td>
                    <td><?= $v->country ? replace($v->country) : '' ?></td>
                </tr>
                <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td colspan="7"> Data are not found </td>
            </tr>
            <?php
        }
    ?>

    </tbody>
</table>
