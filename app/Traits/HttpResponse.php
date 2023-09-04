<?php
    namespace App\Traits;

    trait HttpResponse {
        protected function success($message,$data,$status = 200) {
            return response([
                'succcess' => true,
                'data' => $data,
                'message' => $message,
            ],$status);
        }

        protected function error($message,$data = [],$status = 400) {
            return response([
                'success' => false,
                'data' => $data,
                'message' => $message,
            ],$status);
        }
    }
