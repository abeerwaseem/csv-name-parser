<?php

namespace App;

/**
 * Split a name into its constituent parts
 *
 * Author: Abeer Waseem
 *
*/
class NameParser
{

    /**
    * Parse Static entry point.
    *
    * @param string $csv csv file path to read the names
    * @return array returns associative array of name parts
    */
    public static function parse($csv)
    {
        $parser = new self();
        $row = 1;
        $names = [];

        if (($handle = fopen($csv, "r")) !== FALSE) {
            $data = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    if($data[$c])
                       $names[] = $parser->parse_name($data[$c]);
                }
            }
            fclose($handle);
        }

        return $names;
    }

    /**
    * Main Method which calls all other methods
    *
    * @param string $name the full name you wish to parse
    * @return array returns associative array of name parts
    */
    public function parse_name($name)
    {
        # Remove leading/trailing whitespace
        $name = trim($name);

        $two_persons = false;
        //Break Names if a string contain 2 names
        $person = $this->break_names($name);

        //if more than one name present in a string set $two_person to true, which can be used later
        if(count($person) > 1)
            $two_persons = true;


        $person_details = [];

        //Looping through the name
        for($i=0; $i < count($person); $i++){
            $second_person = null;

            if($two_persons && $i == 0)
                $second_person = $person[$i+1];

            $person_details[$i]['title'] = $this->get_title($person[$i]);
            $person_details[$i]['first_name'] = $this->get_first_name($person[$i]);
            $person_details[$i]['initial'] = $this->get_initial($person[$i]);
            $person_details[$i]['last_name'] = $this->get_last_name($person[$i], $second_person);

        }

        return $person_details;
    }

    /**
    * This Will split names if two or more names availabel in the string
    *
    * @param string $data the names you wish to break
    * @return array returns array of names
    */
    public function break_names($data)
    {
        $names = preg_split('/ (&|and) /', $data);
        return $names;
    }

    /**
    * This will return title from the name
    *
    * @param string $name the name you wish to get title from
    * @return string return title
    */
    public function get_title($name)
    {
        return explode(" ", $name)[0];
    }

    /**
    * This will return first name from the name
    *
    * @param string $name the name you wish to get first name from
    * @return string return first name
    */
    function get_first_name($name)
    {
        $person = explode(" ", $name);

        if(count($person) < 3 || $this->is_initial($person[1]))
            return 'null';

        return $person[1];
    }

    /**
    * This will return last name from the name
    *
    * @param string $first_person the name you wish to get last name from
    * @param string $second_person the secone person name
    * @return string return last name
    */
    public function get_last_name($first_person, $second_person = null)
    {
        $fperson = explode(" ", $first_person);
        $sperson = explode(" ", $second_person);

        if(count($fperson) == 1)
            return (count($sperson) > 2 ) ? $sperson[2] : $sperson[1];

        return (count($fperson) > 2 ) ? $fperson[2] : $fperson[1];
    }

    /**
    * This will return initial from the name
    *
    * @param string $name the name you wish to get title from
    * @return string return title
    */
    public function get_initial($name)
    {
        $person = explode(" ", $name);

        if(count($person) != 1 && (strlen($person[1]) < 3))
            return $person[1];

        return 'null';
    }

   /**
   * Test string to see if it's a single letter/initial (period optional)
   *
   * @param string $word the single word you wish to test
   * @return boolean
   */
   protected function is_initial($word)
   {
        return ((strlen($word) == 1) || (strlen($word) == 2 && (strpos($word[1], '.') !== false)));
   }


}
