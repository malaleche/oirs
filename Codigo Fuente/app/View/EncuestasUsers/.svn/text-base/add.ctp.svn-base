<style>
    input{
        float:left;
        margin-right: 5px!important;
    }
    p{
        clear:both;
        color:#000;
    }
    label{
        color:#000;
    }
</style>

<div class="encuestas form">
    <?php echo $this->Form->create(null, array(
    'url' => array('controller' => 'EncuestasUsers', 'action' => 'add'))); ?>
    <fieldset>
        <legend><?php echo __($encuestas['Encuesta']['encuesta']); ?></legend>
        <div id="encuesta">
            
            <?php
            echo $this->Form->input('EncuestasUser.encuesta_id',array('type'=>'hidden', 'value'=>$encuestas['Encuesta']['id']));
            echo $this->Form->input('EncuestasUser.user_id',array('type'=>'hidden', 'value'=>$this->Session->read('Auth.User.id')));
            if ($encuestas['Pregunta'] != 'NULL'):
                foreach ($encuestas['Pregunta'] as $key => $value):
                    ?>
                    <div name="pregunta" class="alert alert-success">
                        <?php
                        echo $this->Form->label('Pregunta.' . $value['id'] . '.pregunta',$value['pregunta']);
                        $options = array();
                        foreach ($value['Alternativa'] as $key1 => $value1) {
                            $options[$value1['id']] = $value1['alternativa'];
                        }?>
                        <p>
                            <?php
                        echo $this->Form->radio('Pregunta.' . $value['id'] . '.Alternativa', $options,array('legend'=>false,'separator'=>'</p><p>'));
                        ?> 
                        </p>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(array('label' => 'Responder', 'class' => 'btn btn-primary', 'div' => false, 'after' => ' ' . $this->Html->link('Cancelar', array('controller'=>'users', 'action'=>'logout',true),array('class' => 'btn')))); ?>
</div>