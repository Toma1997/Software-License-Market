<?php

class Client{
    
    public $name;
    public $surname;
    public $email;
    public $status;

    private $account;
    private $salary;
    
    function __construct($name, $surname, $email, $status, $account, $salary){
        
        $this->name = $name;
        $this ->surname = $surname;
        $this->email = $email;
        $this ->status = $status;
        $this->setAccount($account);
        $this ->setSalary($salary);
    }

    public function getAccount(){
        return $this->account;
    }

    public function setAccount($newAccount){
        $this->account = $newAccount;
    }

    public function getSalary(){
        return $this->salary;
    }

    public function setSalary($newSalary){
        $this->account = $newSalary;
    }

    
    public function toString(){
        
        return "<b><u>Klijent: </b></u></br>" . 
                "<b>Ime: </b>" . $this->name . "<br/> " . 
               "<b>Prezime: </b>" . $this->surname . "<br/> "  . 
               "<b>Email: </b>" . $this->email . "<br/> " . 
               "<b>Status: </b>" . $this->status . "<br/> " . 
               "<b>Tekuci racun: </b>" . $this->getAccount() . "<br/> " . 
               "<b>Plata: </b>" . $this->getSalary() . "<br/></br> ";
    }
    
    
}

class License{
    
    public $payment;
    public $software;

    private $package;
    private $licenses; // broj narucenih licenci
    
    function __construct($payment, $software, $package, $licenses){
        
        $this->payment = $payment;
        $this ->software = $software;
        $this->setPackage($package);
        $this ->setLicenses($licenses);
    }

    public function getPackage(){
        return $this->package;
    }

    public function setPackage($newPackage){
        $this->package = $newPackage;
    }

    public function getLicenses(){
        return $this->licenses;
    }

    public function setLicenses($newLicenses){
        $this->licenses = $newLicenses;
    }

    
    public function toString(){
        
        return "<b><u>Licenca: </b></u></br>" . 
                "<b>Nacin placanja: </b>" . $this->payment . "<br/> " . 
                "<b>Naziv softvera: </b>" . $this->software . "<br/> "  . 
                "<b>Paket licence: </b>" . $this->getPackage() . "<br/> " . 
                "<b>Broj narucenih licenci: </b>" . $this->getLicenses() . "<br/><br/></br> ";
    }
    
    
}

if(!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['status']) ||
    !isset($_POST['email']) || !isset($_POST['account']) || empty($_POST['name']) || 
    empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['status']) || 
    empty($_POST['account'])){

     die('Not all fields are filled in !!!!');
}

// client data
$name;
$surname;
$email;
$status;
$account;
$salary;

// license data
$payment;
$software;
$package;
$licenses;

if(isset($_POST['name']) && !empty($_POST['name']))
    $name=$_POST['name'];

if(isset($_POST['surname']) && !empty($_POST['surname']))
    $surname=$_POST['surname'];

if(isset($_POST['email']) && !empty($_POST['email']))
    $email=$_POST['email'];
        
if(isset($_POST['status']) && !empty($_POST['status']))
    $status=$_POST['status'];

if(isset($_POST['account']) && !empty($_POST['account']))
    $account=$_POST['account'];

if(isset($_POST['salary']) && !empty($_POST['salary']))
    $salary=$_POST['salary'];

if(isset($_POST['payment']) && !empty($_POST['payment']))
   $payment=$_POST['payment'];
               
               
if(isset($_POST['software']) && !empty($_POST['software']))
    $software=$_POST['software'];

if(isset($_POST['package']) && !empty($_POST['package']))
    $package=$_POST['package'];

if(isset($_POST['licenses']) && !empty($_POST['licenses']))
    $licenses=$_POST['licenses'];

// asocijativni niz licenci i njihovih cena (kao hes tabela)
$licenceIcene = array("anaconda"=>30, "eclipse"=>20, "fritzing"=>35, "matlab"=>16, "navicat"=>15, "netbeans"=>10, "notepad"=>5, "phpstorm"=>25, "python"=>13, "rsa"=>40, "vm"=>12, "vs"=>22);


$total = totalPrice($licenses, $licenceIcene, $software); // ukupan iznos placanja
$average = averagePrice($licenceIcene);

function totalPrice($licenses, $array, $arrKey){

    if($_POST['package'] == 'silver'){
        return $licenses * $array[$arrKey];

    }else if($_POST['package'] == 'gold'){
        return $licenses * $array[$arrKey] * 2;

    }else if($_POST['package'] == 'platinum'){
        return $licenses * $array[$arrKey] * 3;

    }else{
        return "Not defined which package do you want !";
    }
}

function averagePrice($array){
    
    $sum = 0;
    $arraySize = count($array); // broj elemenata niza
    
    foreach ($array as $key => $value){
        $sum += $value;
    }
        
    return $sum/$arraySize;    
}

$indeksLicence = $licenceIcene[$software]; // cuvamo kljuc kupljene licence

switch($software){
        
    case "anaconda": 
        $poruka = "Skup izbor, ali vredan. Imate odlican alat da razvijate Inteligente programe u Python jeziku.";

        $software = "Anaconda Navigator";
        break;

    case "eclipse": 
        $poruka = "Spremi se za razvoj odlicnih aplikacija pre svega u Javi. !";

        $software = "Eclipse IDE";
        break; 

    case "fritzing": 
        $poruka = "Resili ste da se pozabavite programiranje hardvera i </br> ugradjenih sistema? Pravi softver se skinuli za to !";

        $software = "Fritzing";

        break;

    case "matlab": 
        $poruka="Nikad dosta matematike, ali sada je vreme da radite na </br> slozenijim racunima uz pomoc programa !";

        $software = "MatLab";
        break;

    case "navicat":
        $poruka="Jeftin a elegantan. Navicat ce vam pomoci u </br> razvoju profesionalnih baza podataka, i jako brzo ce te ga savladati !";

        $software = "Navicat Premium Essentials";
        break;

    case "netbeans":
        $poruka="Ovo okruzenje je fenomenalno za razvoj !</br> Poseduje dosta plugin-ova za razvoj na raznim programskim jezicima. </br> Ako ste resili da ovde razvijate </br> Veb aplikacije, niste pogresili !";

        $software = "NetBeans IDE 8.2";
        break;

    case "notepad":
        $poruka="Notepad++ je jednostavan i odlican editor za pocetnike. </br> Vrlo brzo cete ga savladati !";

        $software = "Notepad++";
        break;

    case "phpstorm": 
        $poruka = "PHP - Rok N Rol cirilicom :D. </br> Doslo je pravo (ne)vreme za vase mocne veb sajtove i aplikacije !";

        $software = "PhpStorm 4";
        break;

    case "python": 
        $poruka="Zdravo pythosu pravi ! Lagan a odlican za ucenje i  </br> pocetak programiranja u Python. Posle ti preporucujemo Anaconda Navigator !";

        $software = "IDLE Python 3.6";
        break;

    case "rsa":
        $poruka="Konacno neki Softver Arhitekta ili pravi Softver Inzenjer.</br> Ajde razvijte neki inovativni model softvera, vredan milijarde :D ";

        $software= "IBM Rational Software Architect 7.5";
        break;

    case "vm":
        $poruka="Doslo je vreme za Virtuelizaciju i kod vas. </br> Preporucujemo da instalirate </br> Linux Ubuntu, CentOS, Kali Linux, RedHet itd";

        $software = "Oracle VM Virtual Box";
        break;

    case "vs":
        $poruka="Doslo je vreme i verujem da ste sa nestrpljenjem cekali najnoviji Visual Studio !</br>  Krenite sa razvojem mocnih C/C++ ili C# aplikacija !";

        $software = "Microsoft Visual Studio 2017";
        break;

    default:
        $poruka="Nedefinisan softver !";           
        
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>Software License Market</title>
        <link rel="stylesheet" href="assets/css/form.css">
    </head>
    <body>
        <section class="wrapper">
            <header>
                <h1>Software License Market</h1>
            </header>

            <div id="main">
                <header>
                    <nav id="top-menu">
                        <ul>
                            <li><a href="index.html">Home</a>
                            <li><a href="aboutus.html">About us</a>
                            <li><a href="products.html">Products</a>
                            <li><a href="signup.html">Sign up</a>
                        </ul>
                    </nav>
                </header>

                <div id="form">
                    <h1>Uspesna transakcija</h1>
                    <div id="levo">
                        <?php

                            echo "<h3> Prikaz klijenta i licence preko klase </h3></br>";
                            $client= new Client($name, $surname, $email, $status, $account, $salary);
                            echo $client->toString();

                            $license= new License($payment, $software, $package, $licenses);
                            echo $license->toString();
                            echo "</fieldset>";

                            echo "<fieldset><br/>";
                            echo "<b>Name</b>: " . $client->name . "<br/>";
                            echo "<b>Surname</b>: " . $client->surname . "<br/>";
                            echo "<b>Email</b>: " . $client->email . "<br/>";
                            echo "<b> Status: </b> " . $client->status . "<br/>";
                            echo "<b>Payment Account: </b> " . $client->getAccount() . "<br/>";
                            echo "<b> Salary: </b> " . $client->getSalary() . "<br/><br/>";

                            echo "<b>Payment method</b>: " . $license->payment . "<br/>";
                            echo "<b> Software: </b> " . $license->software . "<br/>";
                            echo "<b> Price per license: </b> " . $indeksLicence . "$ <br/>";
                            echo "<b> License package: </b> " . $license->getPackage() . "<br/>";
                            echo "<b> Number of licenses: </b> " . $license->getLicenses() . "<br/>";
                            echo "<b> Total price: </b> " . $total . "</br></br>";
                            date_default_timezone_set('UTC');
                            echo "<b>Datum transakcije:  "  . date('D, d/M/Y') . "</b>";
                        ?>
                    </div>

                    <div id="desno">
                        <?php
                            echo "<h3> Licence </h3><br/>";
                            asort($licenceIcene);
                            while($licenca = each($licenceIcene)){

                                echo "<b>" . $licenca['key'] . ": </b>" . $licenca['value'] . "$ je ";

                                if($licenca['value'] < 18){
                                    echo "jeftina licenca<br/>";

                                } else if($licenca['value'] >= 18 && $licenca['value'] < 30){
                                    echo "srednje cene licenca<br/>";
                                } else{
                                    echo "skupa licenca<br/>";
                                }
                            }
                            echo "<br/>";
                            echo "<b><u>Prosecna cena licenci je: " . $average . "</b></u><br/> <br/>";
                            echo "<h2>" . $poruka . " </h2></br><br/> ";
                        ?>
                    </div>
                </div>
            </div>

            <footer>
                Copyright &copy; All rights reserved. Student: Toma Joksimovic
            </footer>
        </section>
    </body>
</html>