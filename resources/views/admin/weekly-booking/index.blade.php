@include('sweetalert::alert')

<div class="row">
    <div class="col">
        <a href="{{ URL::to('/admin/weekly-booking/create?court_id=') . $court_id }}" id="add-button"
            style="visibility: {{ $court_id? 'visible' : 'hidden' }}" class="btn btn-primary mb-3"><i
                class="fas fa-plus" aria-hidden="true"></i> Tambah/Ubah</a>
    </div>
    <div class="col-3">
        <select name="court_id" id="court_id" class="form-control" placeholder="Title" onchange="reloadPage()">
            <option value="">--Lapangan--</option>
            @foreach ($courts as $court)
            <option value="{{ $court->id }}" {{$court->id == $court_id? "selected" : ""  }}>{{ $court->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="10%">Hari</th>
            <th class="text-center">Jadwal</th>
        </tr>
    </thead>
    <tbody>
         <tr>
            <td class="align-middle">1</td>
            <td class="align-middle {{ $nowDayNumber == 1? "text-primary" : ""}}">Senin</td>
            <td class="align-middle">
                <?php 
                $nowName =  ""; 
                $schedules = $mondaySchedules;
                $index = 0;
                $schedulesCount = count($schedules) + $index;
                ?>                
                @for($i = $index ; $i < $schedulesCount; $i++)
                <?php                  
                    $schedule =  $schedules[$i];   
                    if($nowName != $schedule->weeklyBookingDetails[0]->user->name){?>
                    <div class='d-flex my-2'>
                    @if($nowDayNumber == 1)
                        <form action="{{ URL::to('admin/weekly-booking/receipt') }}" method="POST">
                        @csrf          
                        <input type="hidden" name="user_id" value="{{ $schedule->weeklyBookingDetails[0]->user->id }}"/>       
                        <input type="hidden" name="court_id" value="{{ $court_id }}"/>             
                        <input type="hidden" name="operational_day_id" value="1"/>               
                        <button onclick="return confirm('Anda yakin menyimpan booking mingguan {{ $schedule->weeklyBookingDetails[0]->user->name }}?')" class="btn btn-success btn-sm">{{ $schedule->weeklyBookingDetails[0]->user->name }}</button>                            
                    </form>   
                    @else
                    {{ $schedule->weeklyBookingDetails[0]->user->name }}
                    @endif
                        
                    <?php 
                        $nowName = $schedule->weeklyBookingDetails[0]->user->name;                            
                    }
                ?>
                    <form action="{{ URL::to('/admin/weekly-booking/' . $schedule->weeklyBookingDetails[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data {{ $schedule->weeklyBookingDetails[0]->user->name . ' : ' . $schedule->operationalTime->name }}?')" type="submit" class="btn btn-danger btn-sm mx-1">{{ $schedule->operationalTime->name }} <i class="fas fa-times"></i></button>      
                    </form>       
                @if($i == $schedulesCount - 1 || $nowName != $schedules[$i + 1]->weeklyBookingDetails[0]->user->name)
                </div>                 
                @endif      
                @endfor  
            </td>
        </tr>        
        <tr>
            <td class="align-middle">2</td>
            <td class="align-middle {{ $nowDayNumber == 2? "text-primary" : ""}}">Selasa</td>
            <td>
                <?php 
                $nowName =  ""; 
                $schedules = $tuesdaySchedules;
                $index = $i;                               
                $schedulesCount = count($schedules) + $index;  
                ?>                
                @for($i = $index ; $i < $schedulesCount; $i++)
                <?php                  
                    $schedule =  $schedules[$i];   
                    if($nowName != $schedule->weeklyBookingDetails[0]->user->name){?>
                    <div class='d-flex my-2'>
                    @if($nowDayNumber == 2)
                        <form action="{{ URL::to('admin/weekly-booking/receipt') }}" method="POST">
                        @csrf          
                        <input type="hidden" name="user_id" value="{{ $schedule->weeklyBookingDetails[0]->user->id }}"/>       
                        <input type="hidden" name="court_id" value="{{ $court_id }}"/>             
                        <input type="hidden" name="operational_day_id" value="2"/>               
                        <button onclick="return confirm('Anda yakin menyimpan booking mingguan {{ $schedule->weeklyBookingDetails[0]->user->name }}?')" class="btn btn-success btn-sm">{{ $schedule->weeklyBookingDetails[0]->user->name }}</button>                            
                    </form>   
                    @else
                    {{ $schedule->weeklyBookingDetails[0]->user->name }}
                    @endif
                        
                    <?php 
                        $nowName = $schedule->weeklyBookingDetails[0]->user->name;                            
                    }
                ?>
                    <form action="{{ URL::to('/admin/weekly-booking/' . $schedule->weeklyBookingDetails[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data {{ $schedule->weeklyBookingDetails[0]->user->name . ' : ' . $schedule->operationalTime->name }}?')" type="submit" class="btn btn-danger btn-sm mx-1">{{ $schedule->operationalTime->name }} <i class="fas fa-times"></i></button>      
                    </form>      
                @if($i == $schedulesCount - 1 || $nowName != $schedules[$i + 1]->weeklyBookingDetails[0]->user->name)
                </div>                 
                @endif      
                @endfor                
            </td>
        </tr>
        <tr>
            <td class="align-middle">3</td>
            <td class="align-middle {{ $nowDayNumber == 3? "text-primary" : ""}}">Rabu</td>
            <td>
                <?php      
                $nowName =  ""; 
                $schedules = $wednesdaySchedules;
                $index =  $i;                
                $schedulesCount = count($schedules) + $index;      
                ?>                
                @for($i = $index ; $i < $schedulesCount; $i++)
                <?php                  
                    $schedule =  $schedules[$i];   
                    if($nowName != $schedule->weeklyBookingDetails[0]->user->name){?>
                    <div class='d-flex my-2'>
                    @if($nowDayNumber == 3)
                        <form action="{{ URL::to('admin/weekly-booking/receipt') }}" method="POST">
                        @csrf          
                        <input type="hidden" name="user_id" value="{{ $schedule->weeklyBookingDetails[0]->user->id }}"/>       
                        <input type="hidden" name="court_id" value="{{ $court_id }}"/>             
                        <input type="hidden" name="operational_day_id" value="3"/>               
                        <button onclick="return confirm('Anda yakin menyimpan booking mingguan {{ $schedule->weeklyBookingDetails[0]->user->name }}?')" class="btn btn-success btn-sm">{{ $schedule->weeklyBookingDetails[0]->user->name }}</button>                            
                    </form>   
                    @else
                    {{ $schedule->weeklyBookingDetails[0]->user->name }}
                    @endif
                        
                    <?php 
                        $nowName = $schedule->weeklyBookingDetails[0]->user->name;                            
                    }
                ?>
                    <form action="{{ URL::to('/admin/weekly-booking/' . $schedule->weeklyBookingDetails[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data {{ $schedule->weeklyBookingDetails[0]->user->name . ' : ' . $schedule->operationalTime->name }}?')" type="submit" class="btn btn-danger btn-sm mx-1">{{ $schedule->operationalTime->name }} <i class="fas fa-times"></i></button>      
                    </form>     
                @if($i == $schedulesCount - 1 || $nowName != $schedules[$i + 1]->weeklyBookingDetails[0]->user->name)
                </div>                 
                @endif      
                @endfor                
            </td>
        </tr>
        <tr>
            <td class="align-middle">4</td>
            <td class="align-middle {{ $nowDayNumber == 4? "text-primary" : ""}}">Kamis</td>
            <td>
                <?php 
                $nowName =  ""; 
                $schedules = $thursdaySchedules;
                $index = $i;                
                $schedulesCount = count($schedules) + $index;          
                ?>                
                @for($i = $index ; $i < $schedulesCount; $i++)
                <?php                  
                    $schedule =  $schedules[$i];   
                    if($nowName != $schedule->weeklyBookingDetails[0]->user->name){?>
                    <div class='d-flex my-2'>
                    @if($nowDayNumber == 4)
                        <form action="{{ URL::to('admin/weekly-booking/receipt') }}" method="POST">
                        @csrf          
                        <input type="hidden" name="user_id" value="{{ $schedule->weeklyBookingDetails[0]->user->id }}"/>       
                        <input type="hidden" name="court_id" value="{{ $court_id }}"/>             
                        <input type="hidden" name="operational_day_id" value="4"/>               
                        <button onclick="return confirm('Anda yakin menyimpan booking mingguan {{ $schedule->weeklyBookingDetails[0]->user->name }}?')" class="btn btn-success btn-sm">{{ $schedule->weeklyBookingDetails[0]->user->name }}</button>                            
                    </form>   
                    @else
                    {{ $schedule->weeklyBookingDetails[0]->user->name }}
                    @endif
                        
                    <?php 
                        $nowName = $schedule->weeklyBookingDetails[0]->user->name;                            
                    }
                ?>
                    <form action="{{ URL::to('/admin/weekly-booking/' . $schedule->weeklyBookingDetails[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data {{ $schedule->weeklyBookingDetails[0]->user->name . ' : ' . $schedule->operationalTime->name }}?')" type="submit" class="btn btn-danger btn-sm mx-1">{{ $schedule->operationalTime->name }} <i class="fas fa-times"></i></button>      
                    </form>      
                @if($i == $schedulesCount - 1 || $nowName != $schedules[$i + 1]->weeklyBookingDetails[0]->user->name)
                </div>                 
                @endif      
                @endfor                
            </td>
        </tr>
        <tr>
            <td class="align-middle">5</td>
            <td class="align-middle {{ $nowDayNumber == 5? "text-primary" : ""}}">Jumat</td>
            <td>
                <?php
                $nowName =  ""; 
                $schedules = $fridaySchedules;
                $index =  $i;                
                $schedulesCount = count($schedules) + $index;             
                ?>                
                @for($i = $index ; $i < $schedulesCount; $i++)
                <?php                  
                    $schedule =  $schedules[$i];   
                    if($nowName != $schedule->weeklyBookingDetails[0]->user->name){?>
                    <div class='d-flex my-2'>
                    @if($nowDayNumber == 5)
                        <form action="{{ URL::to('admin/weekly-booking/receipt') }}" method="POST">
                        @csrf          
                        <input type="hidden" name="user_id" value="{{ $schedule->weeklyBookingDetails[0]->user->id }}"/>       
                        <input type="hidden" name="court_id" value="{{ $court_id }}"/>             
                        <input type="hidden" name="operational_day_id" value="5"/>               
                        <button onclick="return confirm('Anda yakin menyimpan booking mingguan {{ $schedule->weeklyBookingDetails[0]->user->name }}?')" class="btn btn-success btn-sm">{{ $schedule->weeklyBookingDetails[0]->user->name }}</button>                            
                    </form>   
                    @else
                    {{ $schedule->weeklyBookingDetails[0]->user->name }}
                    @endif
                        
                    <?php 
                        $nowName = $schedule->weeklyBookingDetails[0]->user->name;                            
                    }
                ?>
                    <form action="{{ URL::to('/admin/weekly-booking/' . $schedule->weeklyBookingDetails[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data {{ $schedule->weeklyBookingDetails[0]->user->name . ' : ' . $schedule->operationalTime->name }}?')" type="submit" class="btn btn-danger btn-sm mx-1">{{ $schedule->operationalTime->name }} <i class="fas fa-times"></i></button>      
                    </form>     
                @if($i == $schedulesCount - 1 || $nowName != $schedules[$i + 1]->weeklyBookingDetails[0]->user->name)
                </div>                 
                @endif      
                @endfor                
            </td>
        </tr>
        <tr>
            <td class="align-middle">6</td>
            <td class="align-middle {{ $nowDayNumber == 6? "text-primary" : ""}}">Sabtu</td>
            <td>
                <?php    
                $nowName =  ""; 
                $schedules = $saturdaySchedules;
                $index = $i;                
                $schedulesCount = count($schedules) + $index;                
                ?>                
                @for($i = $index ; $i < $schedulesCount; $i++)
                <?php                  
                    $schedule =  $schedules[$i];   
                    if($nowName != $schedule->weeklyBookingDetails[0]->user->name){?>
                    <div class='d-flex my-2'>
                    @if($nowDayNumber == 6)
                        <form action="{{ URL::to('admin/weekly-booking/receipt') }}" method="POST">
                        @csrf          
                        <input type="hidden" name="user_id" value="{{ $schedule->weeklyBookingDetails[0]->user->id }}"/>       
                        <input type="hidden" name="court_id" value="{{ $court_id }}"/>             
                        <input type="hidden" name="operational_day_id" value="6"/>               
                        <button onclick="return confirm('Anda yakin menyimpan booking mingguan {{ $schedule->weeklyBookingDetails[0]->user->name }}?')" class="btn btn-success btn-sm">{{ $schedule->weeklyBookingDetails[0]->user->name }}</button>                            
                    </form>   
                    @else
                    {{ $schedule->weeklyBookingDetails[0]->user->name }}
                    @endif
                        
                    <?php 
                        $nowName = $schedule->weeklyBookingDetails[0]->user->name;                            
                    }
                ?>
                    <form action="{{ URL::to('/admin/weekly-booking/' . $schedule->weeklyBookingDetails[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data {{ $schedule->weeklyBookingDetails[0]->user->name . ' : ' . $schedule->operationalTime->name }}?')" type="submit" class="btn btn-danger btn-sm mx-1">{{ $schedule->operationalTime->name }} <i class="fas fa-times"></i></button>      
                    </form>      
                @if($i == $schedulesCount - 1 || $nowName != $schedules[$i + 1]->weeklyBookingDetails[0]->user->name)
                </div>                 
                @endif      
                @endfor                
            </td>
        </tr>
        <tr>
            <td class="align-middle">7</td>
            <td class="align-middle {{ $nowDayNumber == 7? "text-primary" : ""}}">Minggu</td>
            <td>
                <?php 
                $nowName =  ""; 
                $schedules = $sundaySchedules;
                $index = $index + $i;                
                $schedulesCount = count($schedules) + $index;              
                ?>                
                @for($i = $index ; $i < $schedulesCount; $i++)
                <?php                  
                    $schedule =  $schedules[$i];   
                    if($nowName != $schedule->weeklyBookingDetails[0]->user->name){?>
                    <div class='d-flex my-2'>
                    @if($nowDayNumber == 7)
                        <form action="{{ URL::to('admin/weekly-booking/receipt') }}" method="POST">
                        @csrf          
                        <input type="hidden" name="user_id" value="{{ $schedule->weeklyBookingDetails[0]->user->id }}"/>       
                        <input type="hidden" name="court_id" value="{{ $court_id }}"/>             
                        <input type="hidden" name="operational_day_id" value="7"/>               
                        <button onclick="return confirm('Anda yakin menyimpan booking mingguan {{ $schedule->weeklyBookingDetails[0]->user->name }}?')" class="btn btn-success btn-sm">{{ $schedule->weeklyBookingDetails[0]->user->name }}</button>                            
                    </form>   
                    @else
                    {{ $schedule->weeklyBookingDetails[0]->user->name }}
                    @endif
                        
                    <?php 
                        $nowName = $schedule->weeklyBookingDetails[0]->user->name;                            
                    }
                ?>
                    <form action="{{ URL::to('/admin/weekly-booking/' . $schedule->weeklyBookingDetails[0]->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Anda yakin menghapus data {{ $schedule->weeklyBookingDetails[0]->user->name . ' : ' . $schedule->operationalTime->name }}?')" type="submit" class="btn btn-danger btn-sm mx-1">{{ $schedule->operationalTime->name }} <i class="fas fa-times"></i></button>      
                    </form>         
                @if($i == $schedulesCount - 1 || $nowName != $schedules[$i + 1]->weeklyBookingDetails[0]->user->name)
                </div>                 
                @endif      
                @endfor                
            </td>
        </tr>                                        
    </tbody>
</table>

<script>
function reloadPage() {
    const court_id = $('select[name="court_id"]').val();
    window.open(window.location.pathname + (court_id ? ('?court_id=' + court_id) : ''), '_self');
}
</script>