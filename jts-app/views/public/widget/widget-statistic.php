					<div class="widget widget-heading-simple widget-body-white">
						<!-- Widget Heading -->
						<div class="widget-head">
							<h4 class="heading glyphicons stats"><i></i>Statistik Pengunjung</h4>
						</div>
						<!-- // Widget Heading END -->
						<div class="widget-body" style="margin-bottom:10px">
							<p class="margin-none">
								<table width="100%">
								<tr>
									<td width="60%">Hari Ini</td>
									<td width="40%">: <?=digit($statistic['today'])?></td>
								</tr>
								<tr>
									<td>Kemarin</td>
									<td>: <?=digit($statistic['yesterday'])?></td>
								</tr>
								<tr>
									<td>Bulan Ini</td>
									<td>: <?=digit($statistic['month'])?></td>
								</tr>
								<tr>
									<td>Tahun Ini</td>
									<td>: <?=digit($statistic['year'])?></td>
								</tr>
								<tr>
									<td>Semua Waktu</td>
									<td>: <?=digit($statistic['alltime'])?></td>
								</tr>
								</table>
							</p>
						</div>
					</div>