<?php
$info = [['Ed','Cass','Cassidy','Drummer','Spirit'],
	['Christine','Ellen','Hynd','Vocalist','The Pretenders'],
	['Roger','Keith','Barrett','Guitarist','Pink Floyd']];
foreach ($info as $item) {
    list($first,$mid,$last,$role,$band) = $item;
    echo "$first $last is a $role in $band\n";
}
/* outputs:
Ed Cassidy is a Drummer in Spirit
Christine Hynd is a Vocalist in The Pretenders
Roger Barrett is a Guitarist in Pink Floyd */

// this also works
foreach ($info as $item) {
    [$first,$mid,$last,$role,$band] = $item;
    // this also works: [$first,$mid,$last,$role,$band] = $item;
    echo "$first $last is a $role in $band\n";
}
