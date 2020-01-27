<?php

namespace Konstantinn\LaravelGitHubDeploy\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function run(Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = config('deploy.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        if (!hash_equals($githubHash, $localHash)) {
            abort(404);
        }

        $this->clearLogFile();
        $this->writeLog($request->commits[0]['timestamp']. PHP_EOL);
        $this->writeLog('Commit: ' . $request->commits[0]['message']. PHP_EOL);
        foreach(config('deploy.commands') as $command){
            $process = new Process($this->prepareCommands($command));
            $process->setWorkingDirectory(base_path());
            $this->writeLog('***** Command: "'. $command . '"'. PHP_EOL);
            $process->run(function ($type, $buffer) use ($request) {
                $this->writeLog($buffer);
            });
        }

        return 'success';
    }

    private function prepareCommands(string $rawCommand) : array
    {
        return explode(' ', $rawCommand);
    }

    private function writeLog($content)
    {
        File::append(config('deploy.deploy_log_file'), $content);
    }

    private function clearLogFile()
    {
        File::put(config('deploy.deploy_log_file'), '');
    }
}
