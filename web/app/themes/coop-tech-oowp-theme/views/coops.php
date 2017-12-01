<section>
    <div class="row expanded">
        <div class="small-12 small-centered medium-10 large-10 columns">
            <h1>Co-ops</h1>
        </div>
    </div>
    <div class="row expanded">
        <div class="small-12 small-centered medium-10 large-10 columns">
            <table class="people-table">
                <thead>
                <tr>
                    <th >Name</th>
                    <th >Lead time</th>
                    <th >Minimum day rate</th>
                    <th >Standard commercial rate</th>
                    <th >VAT registered?</th>
                    <th >Fixed price contracts</th>
                    <th >Time and materials</th>
                    <th >Legal structure</th>
                </tr>

                </thead>
                <tbody>
                <?php foreach ($this->coops as $coop): /** @var ouCoOp $coop */ ?>
                    <tr>
                        <th><?php echo $coop->htmlLink() ?></th>
                        <th><?php echo $coop->leadTime() ?> months</th>
                        <td><?php echo $coop->minimumDayRate() ?></td>
                        <td><?php echo $coop->standardDayRate(); ?></td>
                        <td><?php echo $coop->vatRegistered(); ?></td>
                        <td><?php echo $coop->fixedPriceContracts() ? "Yes" : ""; ?></td>
                        <td><?php echo $coop->timeAndMaterials() ?  "Yes" : ""; ?></td>
                        <td><?php echo $coop->legalStructure(); ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>