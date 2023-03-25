<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<main class="container">
    <div class="bg-light p-5 rounded">

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <h1><?= $pagetitle; ?></h1>
        <br />
        <form action="<?= base_url(); ?>rekappayment" method="post">
            <div class="mb-3">
                <label for="paper_id" class="form-label">Paper ID *)</label>
                <input type="input" class="form-control" id="paper_id" name="paper_id" placeholder="Paper ID" value="<?= set_value('paper_id'); ?>">
            </div>
            <div class="mb-3">
                <label for="paper_title" class="form-label">Paper Title *)</label>
                <textarea class="form-control" id="paper_title" name="paper_title" rows="3"><?= set_value('paper_title'); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="papper_authors" class="form-label">Paper Authors *)</label>
                <textarea class="form-control" id="paper_authors" name="paper_authors" rows="3"><?= set_value('paper_authors'); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="paper_firstname" class="form-label">Firstname *)</label>
                <input type="input" class="form-control" id="paper_firstname" name="paper_firstname" placeholder="Firstname" value="<?= set_value('paper_firstname'); ?>">
            </div>
            <div class="mb-3">
                <label for="paper_lastname" class="form-label">Lastname *)</label>
                <input type="input" class="form-control" id="paper_lastname" name="paper_lastname" placeholder="Lastname" value="<?= set_value('paper_lastname'); ?>">
            </div>
            <div class="mb-3">
                <label for="payment_email" class="form-label">Email *)</label>
                <input type="email" class="form-control" id="payment_email" name="payment_email" placeholder="Email" value="<?= set_value('payment_email'); ?>">
            </div>
            <div class="mb-3">
                <label for="payment_phone" class="form-label">Phone Number *)</label>
                <input type="input" class="form-control" id="payment_phone" name="payment_phone" placeholder="Phone Number" value="<?= set_value('payment_phone'); ?>>
            </div>
            <div class=" mb-3">
                <label for="payment_type" class="form-label">Type Payment *)</label><br />
                <?php
                if (mktime(0, 0, 0, 7, 17, 2023) > strtotime('now')) {
                ?>
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="earlyRegIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("earlyRegIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Early) Reguler IEEE Member (IDR 3.500.000,-)</label><br />
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="earlyRegNonIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("earlyRegNonIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Early) Reguler Non IEEE Member (IDR 4.000.000,-)</label><br />
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="earlyStudentIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("earlyStudentIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Early) Student IEEE Member (IDR 2.000.000,-)</label><br />
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="earlyStudentNonIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("earlyStudentNonIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Early) Student Non IEEE Member (IDR 2.500.000,-)</label><br />
                <?php
                } else {
                ?>
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="lateRegIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("lateRegIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Late) Reguler IEEE Member (IDR 4.000.000,-)</label><br />
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="lateRegNonIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("lateRegNonIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Late) Reguler Non IEEE Member (IDR 4.500.000,-)</label><br />
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="lateStudentIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("lateStudentIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Late) Student IEEE Member (IDR 2.500.000,-)</label><br />
                    <input type="checkbox" id="payment_type[]" name="payment_type[]" value="lateStudentNonIEEE" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("lateStudentNonIEEE", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;(Late) Student Non IEEE Member (IDR 3.000.000,-)</label><br />
                <?php
                }
                ?>
                <input type="checkbox" id="payment_type[]" name="payment_type[]" value="NonAuthor" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("NonAuthor", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;Non-Author (IDR 1.500.000,-)</label><br />
                <input type="checkbox" id="payment_type[]" name="payment_type[]" value="SocialTour" <?= is_array(set_value('payment_type')) && count(set_value('payment_type[]')) > 0 ? (in_array("SocialTour", set_value('payment_type[]')) ? "checked" : "") : ""; ?>><label for="payment_type"> &nbsp;Additional Social Tour (IDR 2.500.000,-)</label><br />
            </div>
            <br />
            <div class="mb-3">
                <p>Note: Field with *) must be filled</p>
            </div>
            <br />
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="submit" id="submit" value="DoPayment">Payment Proceed</button>
                <button class="btn btn-danger" type="submit" name="submit" id="submit" value="Cancel">Cancel</button>
            </div>
        </form>
    </div>
</main>

<?= $this->endSection(); ?>