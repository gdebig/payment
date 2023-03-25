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
        <p>Thank you for your payment. <strong>Your payment has been successfull</strong>. Please find the email confirmation in your inbox folder or in spam folder.</p>
        <a class="btn btn-lg btn-primary" href="https://icnere.ui.ac.id" role="button">Back to ICNERE 2023 Website &raquo;</a>
    </div>
</main>

<?= $this->endSection(); ?>