<?php

class PurifyBehavior extends ModelBehavior
{
    function setup(Model $model, $settings = array())
    {
        //field is the field we purify by default it is called content
        $field = (isset($settings['field']))?$settings['field']:'content';
        $this->settings[$model->alias] = array('field' => $field);
    }

    /*
        cleaning before saving
    */
    function beforeSave(Model $model)
    {
        //convenient to get the name of the field to clean
        $field = $this->settings[$model->alias]['field'];

        //check if we are working on the field
        if(isset($model->data[$model->alias][$field]))
        {
            //get htmlpurifier => http://htmlpurifier.org/
            App::import('Vendor', null, array
            (
                'file' => 'htmlpurifier'.DS.'library'.DS.'HTMLPurifier.auto.php'
             ));

            //set its configuration
            $config = HTMLPurifier_Config::createDefault();
            $config->set('Core.Encoding', 'UTF-8');
            $config->set('AutoFormat.RemoveEmpty', true);
            $config->set('Core.EscapeNonASCIICharacters', false);

            /*
            allowed HTML elements according to tinymce's configuration => p[align] to allow p and the attribute align
            */
            $allowedHTML = "em,strong,p[style],ul,ol,li,span[style]";
            $config->set('HTML.Allowed', $allowedHTML);

            //cleaning
            $purifier = new HTMLPurifier($config);
            $model->data[$model->alias][$field] = $purifier->purify($model->data[$model->alias][$field]);
        }

        return true;
    }
}

?>