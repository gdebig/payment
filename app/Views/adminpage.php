<?= $this->extend('templateadmin'); ?>

<?= $this->section('content'); ?>

<main class="container">
    <div class="bg-light p-5 rounded">

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-warning"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('err')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('err') ?></div>
        <?php endif; ?>

        <h1><?= $pagetitle; ?></h1>
        <br />
        <?php
        if (isset($data_payment) && ($data_payment == "koosong")) {
        ?>
            <div class="alert alert-danger">Payment Data is empty.</div>
        <?php
        } else {
        ?>
            <h3>Payment List</h3>
            <p><a href="<?= base_url(); ?>verification">Status Verification</a></p>
            <table id="example1" class="display table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Payment ID</th>
                        <th>Paper ID</th>
                        <th>Paper Title</th>
                        <th>Paper Authors</th>
                        <th>Payer Name</th>
                        <th>Payer Email</th>
                        <th>Payer Phone</th>
                        <th>Payer Type</th>
                        <th>Payer Status</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($data_payment as $data) :
                    ?>
                        <tr>
                            <td>
                                <?php
                                echo $i;
                                $i++;
                                ?>
                            </td>
                            <td><?= "ICNERE-" . $data['payment_id']; ?></td>
                            <td><?= $data['paper_id']; ?></td>
                            <td><?= $data['paper_title']; ?>
                            <td><?= $data['paper_authors'] ?></td>
                            <td><?= $data['paper_firstname'] . " " . $data['paper_lastname']; ?></td>
                            <td><?= $data['payment_email']; ?></td>
                            <td><?= $data['payment_phone'] ?></td>
                            <td><?= $data['payment_type']; ?></td>
                            <td><?= $data['payment_status']; ?></td>
                            <td><?= $data['date_modified']; ?></td>
                        </tr>
                    <?php
                    endforeach
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>
</main>

<?= $this->endSection(); ?>