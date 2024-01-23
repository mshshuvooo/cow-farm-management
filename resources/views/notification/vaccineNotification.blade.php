<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vaccine Notification</title>
</head>
<body class="dark-mode-bg-gray-999" style="margin: 0; width: 100%; padding: 0; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #f3f4f6;">
  <div
    role="article"
    aria-roledescription="email"
    aria-label="Your receipt for order 12345"
    lang="en"
  >
    <table
      style="
        width: 100%;
        font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI',
          sans-serif;
      "
      cellpadding="0"
      cellspacing="0"
      role="presentation"
    >
      <tbody>
        <tr>
          <td
            align="center"
            class="dark-mode-bg-gray-999"
            style="background-color: #f3f4f6"
          >
            <table
              class="sm-w-full"
              style="width: 600px"
              cellpadding="0"
              cellspacing="0"
              role="presentation"
            >
              <tbody>
                <tr>
                  <td align="center" class="sm-px-24">
                    <table
                      style="margin: 50px 0 50px 0; width: 100%"
                      cellpadding="0"
                      cellspacing="0"
                      role="presentation"
                    >
                      <tbody>
                        <tr>
                          <td
                            class="dark-mode-bg-gray-989 dark-mode-text-gray-979 sm-px-24"
                            style="
                              background-color: #ffffff;
                              padding: 48px;
                              text-align: left;
                              font-size: 16px;
                              line-height: 24px;
                              color: #1f2937;
                            "
                          >
                            <p
                              class="sm-leading-32 dark-mode-text-white"
                              style="
                                margin: 0;
                                margin-bottom: 36px;
                                font-family: ui-serif, Georgia, Cambria,
                                  'Times New Roman', Times, serif;
                                font-size: 24px;
                                font-weight: 600;
                                color: #000000;
                              "
                            >
                              Notification for upcoming {{ $vaccine_type }} vaccine.
                            </p>

                            <p style="margin: 0; margin-bottom: 24px">
                              Next Vaccination Date: {{ $next_vaccination_date }}
                              <br />
                              Does: 1st
                            </p>
                            <table
                              style="margin-bottom: 32px; width: 100%"
                              cellpadding="0"
                              cellspacing="0"
                              role="presentation"
                            >
                              <thead>
                                <tr>
                                  <th>List Of Cows</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach($cows as $cow)
                                <tr>
                                  <td>{{ $cow->name }} - ({{ $cow->ear_tag_no }})</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <a
                              href="https://example.com"
                              class="hover-bg-blue-600"
                              style="
                                display: inline-block;
                                background-color: #3b82f6;
                                padding-left: 24px;
                                padding-right: 24px;
                                padding-top: 16px;
                                padding-bottom: 16px;
                                text-align: center;
                                font-size: 16px;
                                font-weight: 600;
                                text-transform: uppercase;
                                color: #ffffff;
                                text-decoration: none;
                              "
                            >
                              <span style="mso-text-raise: 16px"
                                >Go to dashboard</span
                              >
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


</body>
</html>
