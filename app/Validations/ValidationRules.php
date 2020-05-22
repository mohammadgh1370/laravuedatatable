<?php

namespace App\Validations;

class ValidationRules
{
    /**
     * @var boolean
     */
    protected $status;

    /**
     * validate mobile number
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @author Shahrokh Niakan <sh.niakan@anetwork.ir>
     * @since May 21, 2016
     * @return boolean
     */
    public function IranMobile($attribute, $value, $parameters, $validator)
    {
        ValidationMessages::setCustomMessages( $validator );

        if ((bool) preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || (bool) preg_match('/^(9){1}[0-9]{9}+$/', $value))
            return true;

        return false;
    }

    /**
     * validate sheba number
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @author Shahrokh Niakan <sh.niakan@anetwork.ir>
     * @since May 21, 2016
     * @return boolean
     */
    public function Sheba($attribute, $value, $parameters, $validator)
    {
        ValidationMessages::setCustomMessages( $validator );

        $ibanReplaceValues = array();

        if (!empty($value)) {
            $value = preg_replace('/[\W_]+/', '', strtoupper($value));

            if (( 4 > strlen($value) ||  strlen($value) > 34 ) || ( is_numeric($value [ 0 ])  || is_numeric($value [ 1 ]) ) || ( ! is_numeric($value [ 2 ]) || ! is_numeric($value [ 3 ]) )) {
                return false;
            }

            $ibanReplaceChars = range('A', 'Z');

            foreach (range(10, 35) as $tempvalue) {
                $ibanReplaceValues[] = strval($tempvalue);
            }


            $tmpIBAN = substr($value, 4) . substr($value, 0, 4);

            $tmpIBAN = str_replace($ibanReplaceChars, $ibanReplaceValues, $tmpIBAN);

            $tmpValue = intval(substr($tmpIBAN, 0, 1));

            for ($i = 1; $i < strlen($tmpIBAN); $i++) {
                $tmpValue *= 10;

                $tmpValue += intval(substr($tmpIBAN, $i, 1));

                $tmpValue %= 97;
            }

            if ($tmpValue != 1) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * validate meliCode number
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @author Shahrokh Niakan <sh.niakan@anetwork.ir>
     * @since May 21, 2016
     * @return boolean
     */
    public function MelliCode($attribute, $value, $parameters, $validator)
    {
        ValidationMessages::setCustomMessages( $validator );

        if (!preg_match('/^\d{8,10}$/', $value) || preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $value)) {
            return false;
        }

        $sub = 0;

        if (strlen($value) == 8) {
            $value = '00' . $value;
        } elseif (strlen($value) == 9) {
            $value = '0' . $value;
        }

        for ($i = 0; $i <= 8; $i++) {
            $sub = $sub + ( $value[$i] * ( 10 - $i ) );
        }

        if (( $sub % 11 ) < 2) {
            $control = ( $sub % 11 );
        } else {
            $control = 11 - ( $sub % 11 );
        }

        if ($value[9] == $control) {
            return true;
        } else {
            return false;
        }

    }

}
