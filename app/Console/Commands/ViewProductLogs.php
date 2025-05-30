<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ViewProductLogs extends Command
{
    protected $signature = 'logs:products {--days=7 : Número de días a mostrar} {--type=all : Tipo de log (all, create, update, delete)}';
    protected $description = 'Ver logs de productos';

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
        
        $this->info("\n=== Logs de Productos ===\n");
        
        $count = 0;
        foreach ($lines as $line) {
            if (empty($line)) continue;
            
            // Verificar si la línea contiene información de productos
            if (str_contains($line, 'Intento de creación de producto') || 
                str_contains($line, 'Producto creado exitosamente') ||
                str_contains($line, 'Imagen de producto guardada') ||
                str_contains($line, 'Error al crear producto')) {
                
                // Filtrar por tipo si se especificó
                if ($type !== 'all') {
                    if ($type === 'create' && !str_contains($line, 'creación') && !str_contains($line, 'creado')) continue;
                    if ($type === 'update' && !str_contains($line, 'actualización')) continue;
                    if ($type === 'delete' && !str_contains($line, 'eliminación')) continue;
                }
                
                // Formatear y mostrar la línea
                $this->formatAndDisplayLog($line);
                $count++;
            }
        }
        
        if ($count === 0) {
            $this->warn('No se encontraron logs de productos.');
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