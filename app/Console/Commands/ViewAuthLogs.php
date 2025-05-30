<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ViewAuthLogs extends Command
{
    protected $signature = 'logs:auth {--days=7 : Número de días a mostrar} {--type=all : Tipo de log (all, login, register, logout)}';
    protected $description = 'Ver logs de autenticación';

    public function handle()
    {
        $days = $this->option('days');
        $type = $this->option('type');
        
        $logFile = storage_path('logs/laravel.log');
        
        if (!File::exists($logFile)) {
            $this->error('No se encontró el archivo de logs.');
            return 1;
        }

        $logs = File::get($logFile);
        $lines = explode("\n", $logs);
        
        $this->info("\n=== Logs de Autenticación ===\n");
        
        $count = 0;
        foreach ($lines as $line) {
            if (empty($line)) continue;
            
            // Verificar si la línea contiene información de autenticación
            if (str_contains($line, 'Intento de registro') || 
                str_contains($line, 'Registro exitoso') ||
                str_contains($line, 'Intento de inicio de sesión') ||
                str_contains($line, 'Inicio de sesión exitoso') ||
                str_contains($line, 'Cierre de sesión')) {
                
                // Filtrar por tipo si se especificó
                if ($type !== 'all') {
                    if ($type === 'login' && !str_contains($line, 'sesión')) continue;
                    if ($type === 'register' && !str_contains($line, 'registro')) continue;
                    if ($type === 'logout' && !str_contains($line, 'Cierre de sesión')) continue;
                }
                
                // Formatear y mostrar la línea
                $this->formatAndDisplayLog($line);
                $count++;
            }
        }
        
        if ($count === 0) {
            $this->warn('No se encontraron logs de autenticación.');
        } else {
            $this->info("\nTotal de logs encontrados: {$count}");
        }
        
        return 0;
    }
    
    private function formatAndDisplayLog($line)
    {
        // Extraer la fecha y el mensaje
        if (preg_match('/\[(.*?)\]/', $line, $matches)) {
            $date = $matches[1];
            $message = substr($line, strpos($line, ']') + 1);
            
            // Determinar el color según el tipo de log
            if (str_contains($line, 'error')) {
                $this->error("[{$date}] {$message}");
            } elseif (str_contains($line, 'warning')) {
                $this->warn("[{$date}] {$message}");
            } else {
                $this->info("[{$date}] {$message}");
            }
        } else {
            $this->line($line);
        }
    }
} 