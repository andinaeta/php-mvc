<?php

class Upload
{
  protected $file;
  protected $allowedTypes = [];

  public function getFile($name)
  {
    $this->file = $_FILES[$name];

    return $_FILES[$name];
  }

  public function setAllowedTypes($types = [])
  {
    $this->allowedTypes = $types;
  }

  public function getFilename($unique = false)
  {
    $name = $this->file['name'];

    if (!$unique) {
      return $name;
    }

    $ext = $this->_getExt($name);
    $name = uniqid() . ".$ext";
    return $name;
  }

  private function _getExt($file_name)
  {
    $ext = explode('.', $file_name);
    $ext = $ext[count($ext) - 1];
    return $ext;
  }

  public function doUpload($path, $new_name = false)
  {
    if (!$new_name) $new_name = $this->file['name'];

    if (!empty($this->allowedTypes)) {
      $ext = $this->_getExt($new_name);

      if (!in_array($ext, $this->allowedTypes)) {
        die('Tipe file tidak diijinkan!');
      }
    }

    return move_uploaded_file($this->file['tmp_name'], $path . $new_name);
  }
}
