<?php

namespace App\Http\Controllers;

use App\Models\Bond_employee;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Box;
use App\Models\Bond_student;

class TesteController extends Controller
{

    public function testes(){
        if(substr_compare("RESGATADO - 12/08/2020", "RESGATADO", 0, 8) == 0){
            echo "igual";
        }else{
            echo "desigual";
        }
    }

    public function inserir(){
        $aluno = array(
            array('idaluno' => '13850','idcaixa' => '213','idano' => '47','nome' => 'LUCIA HELENA CARVALHO AGUIAR','nome_mae' => 'MARIA DAS GRAÃ‡AS CARVALHO AGUIAR','data_nascimento' => '1964-09-13','ordem' => '1'),
            array('idaluno' => '13851','idcaixa' => '213','idano' => '47','nome' => 'VALDINEIA FERREIRA RIBEIRO // FUNCIONARIO','nome_mae' => 'MARIA ARAUJO BEZERRA RIBEIRO','data_nascimento' => '1996-08-13','ordem' => '2'),
            array('idaluno' => '13852','idcaixa' => '213','idano' => '46','nome' => 'PEDRO HENRIQUE GOMES PAIVA','nome_mae' => 'VALDINEDES GOMES PAIVA','data_nascimento' => '1991-02-12','ordem' => '4'),
            array('idaluno' => '13853','idcaixa' => '213','idano' => '47','nome' => 'DALILA ABRÃƒO BRETINI ALVES','nome_mae' => 'LEILA ABRÃƒO BRENTINI','data_nascimento' => '1984-01-30','ordem' => '3'),
            array('idaluno' => '13854','idcaixa' => '213','idano' => '47','nome' => 'KHARITA CERQUEIRA SERPA ROCHA','nome_mae' => 'MARIA DE FATIMA CERQUEIRA SERPA','data_nascimento' => '1988-07-28','ordem' => '5'),
            array('idaluno' => '13855','idcaixa' => '213','idano' => '47','nome' => 'MARIA DA CONCEIÃ‡AO','nome_mae' => 'RAULINA MARIA NETO','data_nascimento' => '1967-03-23','ordem' => '6'),
            array('idaluno' => '13856','idcaixa' => '213','idano' => '47','nome' => 'ARLETE GONCALVES DA SILVA','nome_mae' => 'ALCIDES GONCALVES DA SILVA','data_nascimento' => '1976-10-28','ordem' => '7'),
            array('idaluno' => '13857','idcaixa' => '213','idano' => '47','nome' => 'AILSON MENDES DE SOUZA ','nome_mae' => 'JACINTA MENDES AMARAL','data_nascimento' => '1978-03-17','ordem' => '8'),
            array('idaluno' => '13858','idcaixa' => '213','idano' => '47','nome' => 'BARBARA MEDEIROS VIEIRA','nome_mae' => 'MARIA APARECIDA MEDEIROS','data_nascimento' => '1987-11-06','ordem' => '9'),
            array('idaluno' => '13859','idcaixa' => '213','idano' => '47','nome' => 'CLEONICE ROSA PEREIRA','nome_mae' => 'JUSTA ROSA PEREIRA','data_nascimento' => '1976-11-13','ordem' => '10'),
            array('idaluno' => '13860','idcaixa' => '213','idano' => '47','nome' => 'FABRICIO FILHO SOARES ROCHA','nome_mae' => 'CLEIBE SOARES ROCHA','data_nascimento' => '1995-09-25','ordem' => '11'),
            array('idaluno' => '13861','idcaixa' => '213','idano' => '47','nome' => 'GRACIELE DO NASCIMENTO DE SOUSA BRITO','nome_mae' => 'NADY DO NASCIMENTO DE SOUSA BRITO','data_nascimento' => '1997-03-12','ordem' => '12'),
            array('idaluno' => '13862','idcaixa' => '213','idano' => '47','nome' => 'HENRIQUE BATISTA SOBRINHO','nome_mae' => 'ANDREZINA BATISTA SOBRINHO','data_nascimento' => '1985-12-13','ordem' => '13'),
            array('idaluno' => '13863','idcaixa' => '213','idano' => '47','nome' => 'LARESSA SILVA MIRANDA','nome_mae' => 'ELIZANGELA MENDES DE MIRANDA MARTINS','data_nascimento' => '1994-07-26','ordem' => '14'),
            array('idaluno' => '13864','idcaixa' => '213','idano' => '47','nome' => 'LUCIANE CIRQUEIRA NUNES SOUSA ','nome_mae' => 'DORALICE CIRQUEIRA NUNES','data_nascimento' => '1976-07-08','ordem' => '15'),
            array('idaluno' => '13865','idcaixa' => '213','idano' => '48','nome' => 'MARIA DO CARMO RIBEIRO DOS SANTOS','nome_mae' => 'MARIA BATISTA INACIO','data_nascimento' => '1965-10-18','ordem' => '16'),
            array('idaluno' => '13866','idcaixa' => '213','idano' => '48','nome' => 'TALITA DA SILVA CARVALHO ','nome_mae' => 'ANDREA DA SILVA CARVALHO ','data_nascimento' => '1997-03-04','ordem' => '17'),
            array('idaluno' => '14061','idcaixa' => '213','idano' => '47','nome' => 'DANIELA DE SOUSA RODRIGUES','nome_mae' => 'LAUDECI DE SOUSA DIAS CARVALHO','data_nascimento' => '1993-10-04','ordem' => '18'),
            array('idaluno' => '14062','idcaixa' => '213','idano' => '48','nome' => 'LAUDECI DE SOUSA DIAS CARVALHO','nome_mae' => 'LUIZA RODRIGUES DE SOUSA DIAS','data_nascimento' => '1973-12-04','ordem' => '19'),
            array('idaluno' => '14063','idcaixa' => '213','idano' => '47','nome' => 'FABIANI DE OLIVEIRA BROLLO','nome_mae' => 'IVONI TEREZINHA DE OLIVEIRA BROLLO','data_nascimento' => '1979-01-28','ordem' => '20'),
            array('idaluno' => '14064','idcaixa' => '213','idano' => '46','nome' => 'FLAVIA PEREIRA CARVALHO','nome_mae' => 'LUZINEIDE PEREIRA DA SILVA','data_nascimento' => '1998-11-15','ordem' => '21'),
            array('idaluno' => '14065','idcaixa' => '213','idano' => '48','nome' => 'KARINY PEREIRA DIAS GUEDES','nome_mae' => 'MARIA AUREA PEREIRA DIAS','data_nascimento' => '1991-07-04','ordem' => '22'),
            array('idaluno' => '14066','idcaixa' => '213','idano' => '48','nome' => 'REJANE SILVA SOUSA','nome_mae' => 'RAIMUNDA DA CUNHA E SILVA SOUSA','data_nascimento' => '1979-09-16','ordem' => '23'),
            array('idaluno' => '14067','idcaixa' => '213','idano' => '48','nome' => 'SEBASTIAO MARQUES DA SILVA','nome_mae' => 'RAIMUNDA FRANCISCA DA SILVA','data_nascimento' => '1968-01-09','ordem' => '24'),
            array('idaluno' => '14068','idcaixa' => '213','idano' => '48','nome' => 'RENATO NUNES ALVES','nome_mae' => 'CORINA NUNES ALVES','data_nascimento' => '1986-03-26','ordem' => '25'),
            array('idaluno' => '14069','idcaixa' => '213','idano' => '48','nome' => 'VERA LUCIA ALVES DE SOUSA','nome_mae' => 'ROSA ALVES DA SILVA','data_nascimento' => '1974-11-01','ordem' => '26'),
            array('idaluno' => '14316','idcaixa' => '213','idano' => '48','nome' => 'ANDECYWALLA MARINHO LIMA','nome_mae' => 'EDVAM DIAS MARINHO','data_nascimento' => '1982-02-13','ordem' => '27'),
            array('idaluno' => '14317','idcaixa' => '213','idano' => '48','nome' => 'ARLETE CARVALHO SILVA','nome_mae' => 'FRANICILENE CARVALHO SILVA','data_nascimento' => '1986-03-05','ordem' => '28'),
            array('idaluno' => '14318','idcaixa' => '213','idano' => '49','nome' => 'DENISE DE OLIVEIRA','nome_mae' => 'MARIA DE LOURDES DE OLIVEIRA','data_nascimento' => '1975-05-06','ordem' => '29'),
            array('idaluno' => '14319','idcaixa' => '213','idano' => '48','nome' => 'FRANCISCO GILSON PEREIRA DA SILVA','nome_mae' => 'A','data_nascimento' => '1972-10-09','ordem' => '30'),
            array('idaluno' => '14320','idcaixa' => '213','idano' => '49','nome' => 'ENIVALDA LIMA DE MORAEIS','nome_mae' => 'MARIA DE LOURDES LIMA DE MORAEIS','data_nascimento' => '1983-07-17','ordem' => '31'),
            array('idaluno' => '14321','idcaixa' => '213','idano' => '48','nome' => 'VALDEMIR PEREIRA ALVES','nome_mae' => 'VALDECY ALVES RODRIGUES','data_nascimento' => '1976-01-30','ordem' => '32'),
            array('idaluno' => '14322','idcaixa' => '213','idano' => '49','nome' => 'JOSE PEREIRA DOS SANTOS FILHO','nome_mae' => 'DIONES NAPOLIAO PEREIRA','data_nascimento' => '1990-01-31','ordem' => '33'),
            array('idaluno' => '14323','idcaixa' => '213','idano' => '48','nome' => 'ADELIA SILVA SANTOS','nome_mae' => 'ADELIA SILVA','data_nascimento' => '0198-10-25','ordem' => '34'),
            array('idaluno' => '14497','idcaixa' => '213','idano' => '45','nome' => 'SAMUEL RODRIGUES DE MENEZES','nome_mae' => 'RODOLFO RODRIGUES DE MENEZES','data_nascimento' => '1974-01-05','ordem' => '35'),
            array('idaluno' => '14498','idcaixa' => '213','idano' => '48','nome' => 'WERBETH SANTOS MIRANDA','nome_mae' => 'AA','data_nascimento' => '1980-10-10','ordem' => '36'),
            array('idaluno' => '14583','idcaixa' => '213','idano' => '48','nome' => 'ELISSAMA DE OLIVEIRA MEDEIROS','nome_mae' => 'A','data_nascimento' => '1998-04-01','ordem' => '37')
        );

        foreach($aluno as $a){
            $employee = new Employee;
            $employee->name = trim($a['nome']);
            $employee->date_birth = $a['data_nascimento'];
            $employee->mother = trim($a['nome_mae']);

            $employee->save();

            $bond_employee = new Bond_employee;
            $bond_employee->employee_id = $employee->id;
            //$bond_student->student_id = 6609;
            $bond_employee->box_id = 134;
            $bond_employee->order = $a['ordem'];
            $bond_employee->status = 'ARQUIVADO';
            if($a['idano'] == '29'){
                $bond_employee->exit_year = '2003';
            }elseif($a['idano'] == '30'){
                $bond_employee->exit_year = '2004';
            }elseif($a['idano'] == '31'){
                $bond_employee->exit_year = '2005';
            }elseif($a['idano'] == '32'){
                $bond_employee->exit_year = '2006';
            }elseif($a['idano'] == '33'){
                $bond_employee->exit_year = '2007';
            }elseif($a['idano'] == '34'){
                $bond_employee->exit_year = '2008';
            }elseif($a['idano'] == '35'){
                $bond_employee->exit_year = '2009';
            }elseif($a['idano'] == '36'){
                $bond_employee->exit_year = '2010';
            }elseif($a['idano'] == '37'){
                $bond_employee->exit_year = '2011';
            }elseif($a['idano'] == '38'){
                $bond_employee->exit_year = '2012';
            }elseif($a['idano'] == '39'){
                $bond_employee->exit_year = '2013';
            }elseif($a['idano'] == '40'){
                $bond_employee->exit_year = '2014';
            }elseif($a['idano'] == '41'){
                $bond_employee->exit_year = '2015';
            }elseif($a['idano'] == '43'){
                $bond_employee->exit_year = '2016';
            }elseif($a['idano'] == '44'){
                $bond_employee->exit_year = '2017';
            }elseif($a['idano'] == '45'){
                $bond_employee->exit_year = '2018';
            }elseif($a['idano'] == '46'){
                $bond_employee->exit_year = '2019';
            }elseif($a['idano'] == '47'){
                $bond_employee->exit_year = '2020';
            }elseif($a['idano'] == '48'){
                $bond_employee->exit_year = '2021';
            }elseif($a['idano'] == '49'){
                $bond_employee->exit_year = '2022';
            }elseif($a['idano'] == '28'){
                $bond_employee->exit_year = '2002';
            }elseif($a['idano'] == '26'){
                $bond_employee->exit_year = '2000';
            }elseif($a['idano'] == '27'){
                $bond_employee->exit_year = '2001';
            }
            
            $bond_employee->save();

            echo 'salvo'.$a['ordem'].'<br />';

        }


    }
}
