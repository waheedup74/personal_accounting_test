<?php

    namespace App\traits;

    use Illuminate\Http\JsonResponse;

    trait ApiResponse {
        
        /**
         * ----------------------
         * @param $data
         * @param string $message
         * @param int $status
         * @return JsonResponse
         * api success response
         *  ----------------------
         */
        
        public function sendResponse ( $data, string $message = 'Success', int $status = 200 ): JsonResponse {
            return response ()
                -> json ( [
                              'status'  => $status,
                              'message' => $message,
                              'data'    => $data
                          ],
                          $status
                );
        }
        
        /**
         * ----------------------
         * @param array $data
         * @param string $message
         * @param int $status
         * @return JsonResponse
         * api error response
         *  ----------------------
         */

        public function sendError ( string $message, array $data = [], int $status = 400 ): JsonResponse {
            return response ()
                -> json ( [
                              'status'  => $status,
                              'message' => $message,
                              'data'    => $data
                          ],
                          $status
                );
        }

    }
