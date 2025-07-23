<?php

namespace App\Libraries\Core\Http\Controller;

abstract class AbstractController
{
    protected function handleValidationErrors(array $errors, string $view)
    {
        if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['errors' => $errors]);
            exit;
        }

        return view($view, ['errors' => $errors]);
    }

    protected function handleAjaxSuccess(array $data = [])
    {
        $requestedWith = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '';

        if (strtolower($requestedWith) !== 'xmlhttprequest') {
            return;
        }

        header('Content-Type: application/json');
        echo json_encode(array_merge(
            ['success' => true],
            $data
        ));
        exit;
    }
}
