<?php

namespace Core\Filter;

/**
 * @author Antarus
 * @project Murloc avenue
 */
class GuildesFilter extends \Core\Filter\AbstractFilter {

    public function __construct() {
        $inputFilter = $this->getInputFilter();
        $factory = $this->getInputFactory();

        $inputFilter->add($factory->createInput(array(
                    'name' => 'idGuildes',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'Int')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'Digits'
                        ),
                    )
        )));

        $inputFilter->add($factory->createInput(array(
                    'name' => 'nom',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => '1',
                                'max' => '45'
                            )
                        ),
                    )
        )));

//        $inputFilter->add($factory->createInput(array(
//                    'name' => 'serveur',
//                    'required' => false,
//                    'filters' => array(
//                        array('name' => 'StripTags'),
//                        array('name' => 'StringTrim')
//                    ),
//                    'validators' => array(
//                        array(
//                            'name' => 'StringLength',
//                            'options' => array(
//                                'encoding' => 'UTF-8',
//                                'min' => '0',
//                                'max' => '100'
//                            )
//                        ),
//                    )
//        )));

        $inputFilter->add($factory->createInput(array(
                    'name' => 'idJeux',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'Int')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'Digits'
                        ),
                    )
        )));
        $inputFilter->add($factory->createInput(array(
                    'name' => 'data',
                    'required' => false,
                    'filters' => array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim')
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '65535'
                            )
                        ),
                    )
        )));
    }

}
