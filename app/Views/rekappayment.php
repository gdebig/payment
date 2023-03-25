<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<main class="container">
    <div class="bg-light p-5 rounded">

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <?php
        $trxcode = "ICNERE-" . $payment_id;
        ?>

        <h1><?= $pagetitle; ?></h1>
        <div>
            <table>
                <tr>
                    <td>Transaction Code</td>
                    <td>:</td>
                    <td><?= $trxcode; ?></td>
                </tr>
                <tr>
                    <td>Paper ID</td>
                    <td>:</td>
                    <td><?= $paper_id; ?></td>
                </tr>
                <tr>
                    <td>Paper Title</td>
                    <td>:</td>
                    <td><?= $paper_title; ?></td>
                </tr>
                <tr>
                    <td>Paper Authors</td>
                    <td>:</td>
                    <td><?= $paper_authors; ?></td>
                </tr>
                <tr>
                    <td>Payment Type</td>
                    <td>:</td>
                    <td>
                        <?php
                        $payment_string = explode(",", $payment_type);
                        $total = 0;
                        foreach ($payment_string as $type) {
                            switch ($type) {
                                case "earlyRegIEEE":
                                    echo "Early Regular IEEE Member = 3.500.000 IDR <br />";
                                    $total = $total + 3500000;
                                    break;
                                case "earlyRegNonIEEE":
                                    echo "Early Regular Non IEEE Member = 4.000.000 IDR <br />";
                                    $total = $total + 4000000;
                                    break;
                                case "earlyStudentIEEE":
                                    echo "Early Student IEEE Member = 2.000.000 IDR <br />";
                                    $total = $total + 2000000;
                                    break;
                                case "earlyStudentNonIEEE":
                                    echo "Early Regular Non IEEE Member = 2.500.000 IDR <br />";
                                    $total = $total + 2500000;
                                    break;
                                case "lateRegIEEE":
                                    echo "Late Regular IEEE Member = 4.000.000 IDR <br />";
                                    $total = $total + 4000000;
                                    break;
                                case "lateRegNonIEEE":
                                    echo "Late Regular Non IEEE Member = 4.500.000 IDR <br />";
                                    $total = $total + 4500000;
                                    break;
                                case "lateStudentIEEE":
                                    echo "Late Student IEEE Member = 2.500.000 IDR <br />";
                                    $total = $total + 2500000;
                                    break;
                                case "lateStudentNonIEEE":
                                    echo "Late Student Non IEEE Member = 3.000.000 IDR <br />";
                                    $total = $total + 3000000;
                                    break;
                                case "NonAuthor":
                                    echo "Non Author = 1.500.000 IDR <br />";
                                    $total = $total + 1500000;
                                    break;
                                case "SocialTour":
                                    echo "Social Tour = 2.500.000 IDR <br />";
                                    $total = $total + 2500000;
                                    break;
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Email Confirmation</td>
                    <td>:</td>
                    <td><?= $payment_email; ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>:</td>
                    <td><?= $payment_phone; ?></td>
                </tr>
                <tr>
                    <td>Total Payment</td>
                    <td>:</td>
                    <td><?= number_format($total, 2, ",", ".") . " IDR"; ?></td>
                </tr>
            </table>
        </div>
        <a class="btn btn-lg btn-primary" href="<?= base_url(); ?>dopayment/<?= $payment_id; ?>" role="button">Do Payment &raquo;</a>
        <a class="btn btn-lg btn-danger" href="<?= base_url(); ?>cancelpayment/<?= $payment_id; ?>" role="button">Cancel &raquo;</a>
    </div>
</main>

<?= $this->endSection(); ?>