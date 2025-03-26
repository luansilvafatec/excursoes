<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DeployController extends Controller
{

    public function deploy()
    {
        //git -c safe.directory=/app -C /app pull



        $validPassword = env('GIT_PASSWORD'); // Altere para a senha desejada

        if ($_POST['senha'] !== $validPassword) {
            return response()->json(['error' => 'Senha inválida!'], 403);
        }

        try {

            // $process = new Process([$_POST['comando']]);
            $process = Process::fromShellCommandline($_POST['comando']);
            $process->setWorkingDirectory(base_path());
            $process->setTimeout(3600);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            echo $process->getOutput();

            return;


        } catch (ProcessFailedException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
