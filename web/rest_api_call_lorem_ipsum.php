<?php
// makes a REST GET requet to Lorem Ipsum generator API
const API_URL = 'https://loripsum.net/api';
echo file_get_contents(API_URL);
