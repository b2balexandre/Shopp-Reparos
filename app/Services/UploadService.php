<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UploadService
{
    /**
     * Faz upload de imagem com otimizações
     */
    public function uploadImage(UploadedFile $file, string $path, array $options = [])
    {
        $fileName = $this->generateFileName($file);
        $fullPath = $path . '/' . $fileName;

        try {
            // Upload direto usando Storage (mais eficiente)
            $file->storeAs($path, $fileName, 'public');
            
            Log::info('Upload concluído: ' . $fullPath);
            return $fileName;

        } catch (\Exception $e) {
            Log::error('Erro no upload de imagem: ' . $e->getMessage());
            throw $e;
        }
    }



    /**
     * Gera nome único para o arquivo
     */
    private function generateFileName(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        
        return $name . '_' . time() . '_' . Str::random(8) . '.' . $extension;
    }

    /**
     * Remove arquivo e seus thumbnails
     */
    public function deleteImage(string $path, string $fileName): bool
    {
        try {
            // Remover arquivo principal
            if (Storage::exists($path . '/' . $fileName)) {
                Storage::delete($path . '/' . $fileName);
            }

            // Remover thumbnail se existir
            $thumbnailPath = $path . '/thumbnails/thumb_' . $fileName;
            if (Storage::exists($thumbnailPath)) {
                Storage::delete($thumbnailPath);
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao deletar imagem: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Valida arquivo de upload
     */
    public function validateFile(UploadedFile $file, array $allowedTypes = [], int $maxSize = 5120): bool
    {
        // Verificar tamanho (em KB)
        if ($file->getSize() > ($maxSize * 1024)) {
            return false;
        }

        // Verificar tipo MIME
        if (!empty($allowedTypes) && !in_array($file->getMimeType(), $allowedTypes)) {
            return false;
        }

        return true;
    }
}
