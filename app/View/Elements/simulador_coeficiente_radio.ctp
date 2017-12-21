<div class="field-for-radio">
    <h3><?php echo sprintf('%dx', $coeficiente['prazo']); ?></h3>
    <?php
        $radioOptions = array($coeficiente['id'] => $this->Number->currency($coeficiente['parcela'], 'BRL'));
        $attributes = array('hiddenField' => false);
        echo $this->Form->radio('coeficiente_id', $radioOptions, $attributes);
    ?>
</div>