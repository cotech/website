<section>
    <div class="row expanded">
        <div class="small-12 small-centered medium-10 large-10 columns">
            <h1>People</h1>
        </div>
    </div>
    <div class="row expanded">
        <div class="small-12 small-centered medium-10 large-10 columns">
            <table class="people-table">
                <thead>
                <tr>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Co-op</th>
                    <th rowspan="2">Experience</th>
                    <th rowspan="2">Skills</th>
                    <th colspan="3">Availability (days)</th>
                    <th rowspan="2">Min (cost) rate</th>
                    <th rowspan="2">Standard commercial rate</th>
                </tr>
                <tr>
                    <th>Next 5</th>
                    <th>Next 30</th>
                    <th>Next 90</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->people as $person): /** @var ouPerson $person */ ?>
                    <?php $coOp = $person->coOp(); ?>
                    <tr>
                        <th><?php echo $person->htmlLink() ?></th>
                        <th><?php echo $person->coOp(true)->name() ?></th>
                        <td><?php echo $person->experience() ?> years</td>
                        <td><?php echo $person->servicesList() ?></td>
                        <td><?php echo $person->availability(5) ?></td>
                        <td><?php echo $person->metadata('availabilty_30_days') ?></td>
                        <td><?php echo $person->availability(90) ?></td>
                        <td>£<?php echo $person->costRate() ?></td>
                        <td>£<?php echo $person->commercialRate() ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>