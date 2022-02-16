<?php


namespace App\classes;


class FileUpload
{
    protected $name;
    protected $email;
    protected $phone;
    protected $value;
    protected $result;
    protected $imageName;
    protected $imageDirectory;
    protected $imagePath;
    protected $imageFile;
    protected $filePath;
    protected $file;
    protected $data;
    protected $array;
    protected $array1;
    protected $array2;

    public function __construct($file= null, $post= null)
    {
        if ($post)
        {
            $this->name = $post['name'];
            $this->email = $post['email'];
            $this->phone = $post['phone'];
            $this->value = $post;
        }
        if ($file)
        {
            $this->imageFile = $file['image'];
        }
    }

    public function index()
    {
        $this->imagePath = $this->imageUpload();
        $this->filePath = 'db/db.txt';
        $this->file = fopen($this->filePath, 'a');
        $this->data = "$this->name,$this->email,$this->phone,$this->imagePath$";
//        foreach ($this->value as $item)
//        {
//            fwrite($this->file, $item.',');
//        }

        fwrite($this->file, $this->data);
        fclose($this->file);
        return 'Data Save Successfully';
    }

    protected function imageUpload()
    {
        $this->imageName = time().$this->imageFile['name'];
        $this->imageDirectory = 'assets/img/upload/'.$this->imageName;
        move_uploaded_file($this->imageFile['tmp_name'],$this->imageDirectory);
        return $this->imageDirectory;
    }

    public function getAllStudentsInfo()
    {
        $this->filePath = 'db/db.txt';
        $this->data = file_get_contents($this->filePath);
        $this->array = explode('$', $this->data);

        foreach ($this->array as $key=> $value)
        {
            $this->array2 = explode(',', $value);
            if ($this->array2[0])
            {
                $this->array1[$key]['name'] = $this->array2[0];
                $this->array1[$key]['email'] = $this->array2[1];
                $this->array1[$key]['phone'] = $this->array2[2];
                $this->array1[$key]['image'] = $this->array2[3];
            }
        }
        return $this->array1;
    }
}