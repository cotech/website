<table class="people-table">
    <thead>
    <tr>
        <?php if (!empty($showCoOp)): ?>
            <th rowspan="2">Co-op</th>
        <?php endif; ?>
        <th rowspan="2">Name</th>
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
    <?php foreach ($people as $person): /** @var ouPerson $person */ ?>
        <tr>
            <?php if (!empty($showCoOp)): ?>
                <th><?= $person->coOp(true)->htmlLink() ?></th>
            <?php endif; ?>
            <th><?= $person->htmlLink() ?></th>
            <td><?= $person->experience() ?> years</td>
            <td><?= implode(", ", [$person->servicesList(), $person->technologiesList()]); ?></td>
            <td><?= $person->availability(5) ?></td>
            <td><?= $person->metadata('availabilty_30_days') ?></td>
            <td><?= $person->availability(90) ?></td>
            <td>£<?= $person->costRate() ?></td>
            <td>£<?= $person->commercialRate() ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>