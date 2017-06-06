<?php
class MyClass {
    const FORMAT_DMY = 'd M Y';
    const FORMAT_YMD = 'Y-m-d';
    public function getDMY(DateTime $date)
    {
        return $date->format(self::FORMAT_DMY);
    }
    public function getYMD(DateTime $date)
    {
        return $date->format(self::FORMAT_YMD);
    }
}
Reflection::export(new ReflectionClass('MyClass'));
// output:
/*
Class [ <user> class MyClass ] {
  @@ /home/fred/Desktop/Repos/classic_php_examples/date_time/date_time_pseudo_international.php 2-13

  - Constants [2] {
    Constant [ public string FORMAT_DMY ] { d M Y }
    Constant [ public string FORMAT_YMD ] { Y-m-d }
  }

  - Static properties [0] {
  }

  - Static methods [0] {
  }

  - Properties [0] {
  }

  - Methods [2] {
    Method [ <user> public method getDMY ] {
      @@ /home/fred/Desktop/Repos/classic_php_examples/date_time/date_time_pseudo_international.php 5 - 8

      - Parameters [1] {
        Parameter #0 [ <required> DateTime $date ]
      }
    }

    Method [ <user> public method getYMD ] {
      @@ /home/fred/Desktop/Repos/classic_php_examples/date_time/date_time_pseudo_international.php 9 - 12

      - Parameters [1] {
        Parameter #0 [ <required> DateTime $date ]
      }
    }
  }
}
*/
