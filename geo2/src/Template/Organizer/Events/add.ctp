<link rel="stylesheet" href="/select2/select2.css" type="text/css">
<link rel="stylesheet" href="/select2/select2-bootstrap.css">
<script src="/select2/select2.js"></script>

<script type="text/javascript">

$(document).ready(function(){

    $("#location-id").select2();

    $("#date").datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        maxDate: "+3M",
        constrainInput: false,
        todayBtn: "linked",
        changeMonth: true,
        numberOfMonths: 1,
        onSelect: function(selectedDate) {
        }
    });

});

</script>


<h2>Add Event</h2>

<div class="row">
    <div class="col-sm-5">

        <?php echo $this->Form->create($event); ?>

        <?php echo $this->Form->input('location_id', ['options' => $locations, 'class' => 'form-control', 'selected' => $location]); ?>

        <br />

        <div class="row">
            <div class="col-sm-4">
                <?php //echo $this->Form->input('start_date', array('class' => 'form-control', 'div' => array('class' => 'control-group form-inline'), 'minYear' => date('Y'), 'maxYear' => date('Y') + 1, 'interval' => 5)); ?>
                <?php echo $this->Form->input('date', array('type' => 'text', 'class' => 'form-control', 'size' => 11, 'maxLength' => 10)); ?>
                <br />
            </div>
            <div class="col-sm-8">
                <label for="EventStartTime">Start Time</label>
                <?php
                    echo $this->Form->input('time', array(
                    'type' => 'datetime',
                    'label' => FALSE,
                    'timeFormat' => 24,
                    'dateFormat' => 'Hi',
                    'interval' => 5,
                    'class' => 'form-control',
                    'div' => array('class' => 'control-group form-inline'),
                    ));
                ?>
                <br />
            </div>
        </div>
        <?php echo $this->Form->error('start_date'); ?>


        <?php
            // echo $this->Form->input('start_date');
            // echo $this->Form->input('end_date');
        ?>

        <?php echo $this->Form->input('capacity', array('class' => 'form-control', 'options' => array(16 => 16, 20 => 20), 'default' => $capacity)); ?>
        <br />
        <?php echo $this->Form->input('price', array('class' => 'form-control', 'min' => '0', 'max' => '100', 'step' => '1', 'value' => $price, 'required' => FALSE)); ?>
        <br />
        <?php echo $this->Form->input('description', array('class' => 'form-control')); ?>
        <br />
        <?php echo $this->Form->input('active', array('type' => 'checkbox')); ?>



        <?php echo $this->Form->button('Submit', ['class' => 'btn btn-primary']); ?>
        <?php echo $this->Form->end(); ?>

    </div>
</div>


