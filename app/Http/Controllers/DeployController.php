<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DeployController extends Controller
{
    public function deploy($password)
    {
        dd(base_path());
        $validPassword = env('GIT_PASSWORD'); // Altere para a senha desejada

        if ($password !== $validPassword) {
            return response()->json(['error' => 'Senha inválida!'], 403);
        }

        try {
            $basePath = base_path(); // Obtém o diretório raiz do projeto

            $commands = [
                'composer install',
                'npm install',
                'php artisan migrate',
                'npm run build'
            ];

            // Armazena as saídas dos comandos
            $output = [];

            foreach ($commands as $command) {
                $process = Process::fromShellCommandline($command, $basePath);

                $process->run(function ($type, $buffer) use (&$output) {
                    $output[] = $buffer;
                    echo $buffer; // Isso permite a saída em tempo real no console
                });

                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
            }

            return response()->json(['success' => 'Deploy realizado com sucesso!', 'output' => implode("\n", $output)]);
        } catch (ProcessFailedException $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
