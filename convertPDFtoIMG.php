<?php
$im = new Imagick();

$im->setResolution(300,300);
$im->readimage('pdffile.pdf[0]'); 
$im->setImageFormat('jpeg');    
$im->writeImage('thumb.jpg'); 
$im->clear(); 
$im->destroy();