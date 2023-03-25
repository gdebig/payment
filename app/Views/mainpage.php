<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<main class="container">
    <div class="bg-light p-5 rounded">

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('err')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('err') ?></div>
        <?php endif; ?>

        <h1><?= $pagetitle; ?></h1>
        <p class="has-vivid-red-color has-text-color"><strong>Registration Fee for ICNERE-FTS IC:</strong></p>

        <table id="example1" class="display table table-bordered table-hover">
            <tbody>
                <tr>
                    <td></td>
                    <td class="has-text-align-center" data-align="center">Early <br> (by July 17<sup>th</sup>, 2023)</td>
                    <td class="has-text-align-center" data-align="center">Late<br> (July 17<sup>th</sup>, 2023 &#8211; July 31<sup>st</sup>, 2023)</td>
                </tr>
                <tr>
                    <td>Regular IEEE Member</td>
                    <td class="has-text-align-center" data-align="center">3.500.000 IDR</td>
                    <td class="has-text-align-center" data-align="center">4.000.000 IDR</td>
                </tr>
                <tr>
                    <td>Regular Non-IEEE Member</td>
                    <td class="has-text-align-center" data-align="center">4.000.000 IDR</td>
                    <td class="has-text-align-center" data-align="center">4.500.000 IDR</td>
                </tr>
                <tr>
                    <td>Student IEEE Member</td>
                    <td class="has-text-align-center" data-align="center">2.000.000 IDR</td>
                    <td class="has-text-align-center" data-align="center">2.500.000 IDR</td>
                </tr>
                <tr>
                    <td>Student Non-IEEE Member</td>
                    <td class="has-text-align-center" data-align="center">2.500.000 IDR</td>
                    <td class="has-text-align-center" data-align="center">3.000.000 IDR</td>
                </tr>
                <tr>
                    <td>Non-author</td>
                    <td class="has-text-align-center" data-align="center">1.500.000 IDR</td>
                    <td class="has-text-align-center" data-align="center">1.500.000 IDR</td>
                </tr>
                <tr>
                    <td>Social Tour</td>
                    <td class="has-text-align-center" data-align="center">2.500.000 IDR</td>
                    <td class="has-text-align-center" data-align="center">2.500.000 IDR</td>
                </tr>
            </tbody>
        </table>

        <br />
        <a class="btn btn-lg btn-primary" href="<?= base_url(); ?>formpayment" role="button">Form Payment &raquo;</a>
    </div>
</main>

<?= $this->endSection(); ?>