<?php
    /*
     * The following code shows how to decode data (in this case, GPS
     * coordinates, see  "sigfox_gps" Arduino sketch for more information),
     * and display the results.
     *
     * Official repository for this code :
     *   https://github.com/aboudou/SmartEverything_SigFox_GPS
     *
     * Feel free to clone it, modify it, improve it… The following code is
     * licensed under the BSD 2-Clauses License.
     * Copyright (c) 2015, Arnaud Boudou
     * All rights reserved.
     *
     * Redistribution and use in source and binary forms, with or without
     * modification, are permitted provided that the following conditions
     * are met:
     *
     * 1. Redistributions of source code must retain the above copyright
     * notice, this list of conditions and the following disclaimer.
     *
     * 2. Redistributions in binary form must reproduce the above copyright
     * notice, this list  of conditions and the following disclaimer in the
     * documentation and/or other materials provided with the distribution.
     *
     * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
     * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
     * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
     * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
     * HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
     * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
     * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
     * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
     * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
     * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
     * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
     */

    // Data received by SigFox backend
    // This data represents 12 bytes, in hexadecimal format (two char per byte)
    $data = "000000923fc46152422d46e6";

    // Bytes from 1 to 4 are altitude value, in 32 bits integer format, 
    //   bytes in reverse order
    $binarydata32 = pack('H*',reverseBytes(substr($data, 0, 8)));
    $altitude = unpack("V", $binarydata32);

    // Bytes from 5 to 8 are longitude value, in float format, bytes in
    //   reverse order
    $binarydata32 = pack('H*',reverseBytes(substr($data, 8, 8)));
    $longitude = unpack("f", $binarydata32);

    // Bytes from 9 to 12 are latitude value, in float value, bytes in 
    //   reverse order
    $binarydata32 = pack('H*',reverseBytes(substr($data, 16, 8)));
    $latitude = unpack("f", $binarydata32);

    echo 'altitude  : ' . $altitude[1]  . "\r\n";
    echo 'longitude : ' . $longitude[1] . "\r\n";
    echo 'latitude  : ' . $latitude[1]  . "\r\n";

    // Reverse bytes as they come in the reverse order from SigFox network
    function reverseBytes($input) {
        $result = '';
        // first byte
        $result .= substr($input, 6, 2);

        // second byte
        $result .= substr($input, 4, 2);

        // third byte
        $result .= substr($input, 2, 2);

        // fourth byte
        $result .= substr($input, 0, 2);

        return $result;
    }
?>
